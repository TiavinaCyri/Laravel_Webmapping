import Map from "ol/Map.js";
import View from "ol/View.js";
import { Tile as TileLayer } from "ol/layer.js";
import { Style, Fill, Stroke, Circle, Text } from "ol/style.js";
import OSM from "ol/source/OSM.js";
import Overlay from "ol/Overlay.js";
import TileWMS from "ol/source/TileWMS.js";
import VectorSource from "ol/source/Vector";
import VectorLayer from "ol/layer/Vector";
import GeoJSON from "ol/format/GeoJSON";

document.addEventListener("alpine:init", () => {
  Alpine.data("map", function () {
    return {
      legendOpened: false,
      map: {},
      activeTab: "legend",
      initComponent() {
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

        // * layer for colored layer
        let paramsObj = {
          servive: "WFS",
          version: "2.0.0",
          request: "GetFeature",
          typeName: "laravelgis:foret",
          outputFormat: "application/json",
          crs: "EPSG:4326",
          srsName: "EPSG:4326",
        };
        const baseUrl = "http://localhost:8081/geoserver/wfs?";
        let urlParams = new URLSearchParams(paramsObj);
        let foretLayer = new VectorLayer({
          source: new VectorSource({
            format: new GeoJSON(),
            url: baseUrl + urlParams.toString(),
          }),
          style: this.foretStyle,
          label: "Forêts",
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

        // console.log(this.map.getAllLayers().reverse().get('label'));

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

                  let content =
                    "<div class='space-y-5'>" +
                    '<h4 class="text-gray-500 font-bold">Nom du batiment : ' +
                    jsonFeature.nom_bati +
                    "</h4>" +
                    '<h4 class="text-gray-500 font-bold">Type de batiment : ' +
                    jsonFeature.type_bati +
                    "</h4>" +
                    "</div>";

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
      foretStyle(feature, resolution) {
        return new Style({
          fill: new Fill({
            color: "#22c55e",
          }),
          stroke: new Stroke({
            color: "#14532d",
            width: 2,
          }),
          text: new Text({
            font: "25px serif bold",
            text: feature.id_,
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
      infoBatiModal(jsonFeature) {
        let overlay = this.map.getOverlayById("info");
        overlay.setPosition(undefined);
        this.$refs.popupContent.innerHTML = "";

        let content =
          "<div class='space-y-5'>" +
          '<h4 class="text-gray-500 font-bold">Nom du batiment : ' +
          jsonFeature.properties.nom_bati +
          "</h4>" +
          '<h4 class="text-gray-500 font-bold">Type de batiment : ' +
          jsonFeature.properties.type_bati +
          "</h4>" +
          "</div>";

        this.$refs.popupContent.innerHTML = content;

        setTimeout(() => {
          overlay.setPosition(jsonFeature.geometry.coordinates[0][0][0]);
        }, 500);

        return;
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
