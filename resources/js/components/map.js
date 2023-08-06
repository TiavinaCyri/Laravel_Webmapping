import Map from "ol/Map.js";
import View from "ol/View.js";
import TileLayer from "ol/layer/Tile.js";
import VectorSource from "ol/source/Vector";
import VectorLayer from "ol/layer/Vector";
import OSM from "ol/source/OSM.js";
import { Style, Fill, Stroke, Circle, Text } from "ol/style.js";
import GeoJSON from "ol/format/GeoJSON";
import Overlay from "ol/Overlay.js";

document.addEventListener("alpine:init", () => {
    Alpine.data("map", function () {
        return {
            legendOpened: false,
            map: {},
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

                paramsObj.typeName = "laravelgis:monuments";
                let urlParams = new URLSearchParams(paramsObj);

                let monumentsLayer = new VectorLayer({
                    source: new VectorSource({
                        format: new GeoJSON(),
                        url: baseUrl + urlParams.toString(),
                    }),
                    style: this.monumentsStyleFunction,
                    label: 'Monuments',
                });

                paramsObj.typeName = "laravelgis:world-administrative-boundaries";
                urlParams = new URLSearchParams(paramsObj);

                let worldAdministrativeBoundariesLayer = new VectorLayer({
                    source: new VectorSource({
                        format: new GeoJSON(),
                        url: baseUrl + urlParams.toString(),
                    }),
                    style: this.worldAdministrativeBoundariesStyleFunction,
                    label: 'World Administrative Boundaries',
                });

                paramsObj.typeName = "laravelgis:bati";
                urlParams = new URLSearchParams(paramsObj);

                let worldRiversLayer = new VectorLayer({
                    source: new VectorSource({
                        format: new GeoJSON(),
                        url: baseUrl + urlParams.toString(),
                    }),
                    style: this.worldRiversStyleFunction,
                    label: 'World Rivers',
                });

                this.map = new Map({
                    target: this.$refs.map,
                    layers: [
                        new TileLayer({
                            source: new OSM(),
                            label: 'OpenStreetMap',
                        }),
                        worldAdministrativeBoundariesLayer,
                        worldRiversLayer,
                        monumentsLayer
                    ],
                    view: new View({
                        projection: "EPSG:4326",
                        center: [0, 0],
                        zoom: 2,
                    }),
                    overlays: [
                        new Overlay({
                            id: 'info',
                            element: this.$refs.popup,
                            stopEvent: true,
                        }),
                    ],
                });

                this.map.on("singleclick", (event) => {
                    if (event.dragging) {
                        return;
                    }

                    let overlay = this.map.getOverlayById('info')
                    overlay.setPosition(undefined)
                    this.$refs.popupContent.innerHTML = ''

                    this.map.forEachFeatureAtPixel(
                        event.pixel,
                        (feature, layer) => {
                            if (layer.get('label') === 'Monuments' && feature) {
                                this.gotoFeature(feature)

                                let content =
                                    '<h4 class="text-gray-500 font-bold">' +
                                    feature.get('name') +
                                    '</h4>'

                                content +=
                                    '<img src="' +
                                    feature.get('image') +
                                    '" class="mt-2 w-full max-h-[200px] rounded-md shadow-md object-contain overflow-clip">'

                                this.$refs.popupContent.innerHTML = content

                                setTimeout(() => {
                                    overlay.setPosition(
                                        feature.getGeometry().getCoordinates()
                                    );
                                }, 500)

                                return
                            }
                        },
                        {
                            hitTolerance: 5,
                        }
                    );
                });
            },
            closePopup() {
                let overlay = this.map.getOverlayById('info')
                overlay.setPosition(undefined)
                this.$refs.popupContent.innerHTML = ''
            },
            monumentsStyleFunction(feature, resolution) {
                return new Style({
                    image: new Circle({
                        radius: 4,
                        fill: new Fill({
                            color: "rgba(0, 255, 255, 1)",
                        }),
                        stroke: new Stroke({
                            color: "rgba(192, 192, 192, 1)",
                            width: 2,
                        }),
                    }),
                    text: new Text({
                        font: "12px sans-serif",
                        textAlign: "left",
                        text: feature.get("name"),
                        offsetY: -15,
                        offsetX: 5,
                        backgroundFill: new Fill({
                            color: "rgba(255, 255, 255, 0.5)",
                        }),
                        backgroundStroke: new Stroke({
                            color: "rgba(227, 227, 227, 1)",
                        }),
                        padding: [5, 2, 2, 5],
                    }),
                });
            },
            worldAdministrativeBoundariesStyleFunction(feature, resolution) {
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
            worldRiversStyleFunction(feature, resolution) {
                let text;
                let width = 2;

                if(resolution < 0.002){
                    text = new Text({
                        font: "20px serif",
                        text: feature.get("river_map"),
                        fill: new Fill({
                            color: "rgba(0, 0, 255, 1)",
                        }),
                    });

                    width = 4;
                }

                return new Style({
                    stroke: new Stroke({
                        color: "rgba(0, 0, 255, 1)",
                        width: width,
                    }),
                    text: text,
                });
            },
            gotoFeature(feature) {
                this.map.getView().animate({
                    center: feature.getGeometry().getCoordinates(),
                    zoom: 15,
                    duration: 500,
                });
            },
        };
    });
});