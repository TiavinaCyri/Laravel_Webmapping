import Map from "ol/Map.js";
import View from "ol/View.js";
import { Tile as TileLayer } from "ol/layer.js";
import VectorLayer from "ol/layer/Vector";
import VectorSource from "ol/source/Vector";
import GeoJSON from "ol/format/GeoJSON";
import { Style, Fill, Stroke, Text } from "ol/style.js";
import OSM from "ol/source/OSM.js";
import Overlay from "ol/Overlay.js";
import TileWMS from "ol/source/TileWMS.js";
import Feature from "ol/Feature";
import Point from "ol/geom/Point.js";

document.addEventListener("alpine:init", () => {
  Alpine.data("map", function () {
    return {
      legendOpened: false,
      map: {},
      activeTab: "legend",
      initComponent() {
        let paramsObj = {
          servive: "WFS",
          version: "2.0.0",
          request: "GetFeature",
          outputFormat: "application/json",
          crs: "EPSG:4326",
          srsName: "EPSG:4326",
        };

        const baseUrl = "http://localhost:8081/geoserver/wfs?";

        paramsObj.typeName = "laravelgis:bati";
        let urlParams = new URLSearchParams(paramsObj);

        let batiLayer = new TileLayer({
          source: new TileWMS({
            url: "http://localhost:8081/geoserver/wms",
            params: {
              LAYERS: "laravelgis:bati",
              TILED: true,
              STYLES: "",
            },
            serverType: "geoserver",
          }),
          label: "Batiments",
        });

        let routeLayer = new TileLayer({
          source: new TileWMS({
            url: "http://localhost:8081/geoserver/wms",
            params: {
              LAYERS: "laravelgis:route",
              TILED: true,
              STYLES: "",
            },
            serverType: "geoserver",
          }),
          label: "Routes",
        });

        paramsObj.typeName = "laravelgis:foret";
        urlParams = new URLSearchParams(paramsObj);

        let foretLayer = new VectorLayer({
          source: new VectorSource({
            format: new GeoJSON(),
            url: baseUrl + urlParams.toString(),
          }),
          style: this.foretStyle,
          label: "Foret",
        });

        this.map = new Map({
          target: this.$refs.map,
          layers: [
            new TileLayer({
              source: new OSM(),
              label: "OpenStreetMap",
            }),
            batiLayer,
            foretLayer,
            routeLayer,
          ],
          view: new View({
            projection: "EPSG:4326",
            center: [47.8836532, -18.9282945],
            zoom: 17,
          }),
          overlays: [
            new Overlay({
              id: "info",
              element: this.$refs.popup,
              stopEvent: true,
            }),
          ],
        });

        // * OnClick Event
        this.map.on("singleclick", (event) => {
          if (event.dragging) {
            return;
          }

          let overlay = this.map.getOverlayById("info");
          overlay.setPosition(undefined);
          this.$refs.popupContent.innerHTML = "";

          const viewResolution = /** @type {number} */ (
            event.map.getView().getResolution()
          );

          // * onclick batiments
          const url_bati = batiLayer
            .getSource()
            .getFeatureInfoUrl(event.coordinate, viewResolution, "EPSG:4326", {
              INFO_FORMAT: "application/json",
            });

          if (url_bati) {
            fetch(url_bati)
              .then((response) => response.json())
              .then((json) => {
                if (json.features.length > 0) {
                  let jsonFeature = json.features[0].properties;

                  console.log(jsonFeature);

                  let content =
                    '<h4 class="text-gray-500 font-bold">Nom du batiment : ' +
                    jsonFeature.nom_bati +
                    "</h4>";
                  '<h4 class="text-gray-500 font-bold">Nom du batiment : ' +
                    jsonFeature.type_bati +
                    "</h4>";
                  this.$refs.popupContent.innerHTML = content;

                  setTimeout(() => {
                    overlay.setPosition(event.coordinate);
                  }, 500);

                  return;
                }
              });
          }
        });
      },
      batiStyle(feature, resolution) {
        return new Style({
          fill: new Fill({
            color: "rgba(125, 125, 125, 0.1)",
          }),
          stroke: new Stroke({
            color: "rgba(125, 125, 125, 1)",
            width: 2,
          }),
          text: new Text({
            font: "16px serif bold",
            text: feature.get("name"),
            fill: new Fill({
              color: "rgba(32, 32, 32, 1)",
            }),
          }),
        });
      },
      foretStyle(feature, resolution) {
        return new Style({
          fill: new Fill({
            color: "#22c55e",
          }),
          stroke: new Stroke({
            color: "#1a2e05",
            width: 2,
          }),
          text: new Text({
            font: "16px serif bold",
            text: feature.get("name"),
            fill: new Fill({
              color: "rgba(32, 32, 32, 1)",
            }),
          }),
        });
      },
      closePopup() {
        let overlay = this.map.getOverlayById("info");
        overlay.setPosition(undefined);
        this.$refs.popupContent.innerHTML = "";
      },
      gotoFeature(feature) {
        this.map.getView().animate({
          center: feature.getGeometry().getCoordinates(),
          zoom: 15,
          duration: 500,
        });
      },
      hasLegend(layer) {
        return layer.getSource() instanceof TileWMS;
      },
      legendUrl(layer) {
        if (this.hasLegend(layer)) {
          return layer
            .getSource()
            .getLegendUrl(this.map.getView().getResolution(), {
              LEGEND_OPTIONS: "forceLabels:on",
            });
        }
      },
    };
  });
});
