import Map from "ol/Map.js";
import View from "ol/View.js";
import {
    Tile as TileLayer
} from 'ol/layer.js';
import OSM from "ol/source/OSM.js";
import Overlay from "ol/Overlay.js";
import TileWMS from 'ol/source/TileWMS.js';
import Feature from "ol/Feature";
import Point from 'ol/geom/Point.js';

document.addEventListener("alpine:init", () => {
    Alpine.data("map", function () {
        return {
            legendOpened: false,
            map: {},
            activeTab: 'legend',
            initComponent() {
                let monumentsLayer = new TileLayer({
                    source: new TileWMS({
                        url: 'http://localhost:8081/geoserver/wms',
                        params: {
                            'LAYERS': 'laravelgis:monuments',
                            'TILED': true
                        },
                        serverType: 'geoserver',
                    }),
                    label: 'Monuments',
                });

                let batiLayer = new TileLayer({
                    source: new TileWMS({
                        url: 'http://localhost:8081/geoserver/wms',
                        params: {
                            'LAYERS': 'laravelgis:bati',
                            'TILED': true
                        },
                        serverType: 'geoserver',
                    }),
                    label: 'Batiments',
                });

                this.map = new Map({
                    target: this.$refs.map,
                    layers: [
                        new TileLayer({
                            source: new OSM(),
                            label: 'OpenStreetMap',
                        }),
                        batiLayer,
                        monumentsLayer
                    ],
                    view: new View({
                        projection: "EPSG:4326",
                        center: [47.8836532,-18.9282945],
                        zoom: 17,
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

                    const viewResolution = /** @type {number} */ (event.map.getView().getResolution())

                    const url = monumentsLayer.getSource().getFeatureInfoUrl(
                        event.coordinate,
                        viewResolution,
                        'EPSG:4326', {
                            'INFO_FORMAT': 'application/json'
                        })

                    if (url) {
                        fetch(url)
                            .then((response) => response.json())
                            .then((json) => {
                                if (json.features.length > 0) {
                                    let jsonFeature = json.features[0]

                                    let feature = new Feature({
                                        geometry: new Point(jsonFeature.geometry.coordinates),
                                        name: jsonFeature.properties.name,
                                        image: jsonFeature.properties.image
                                    })

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
                            });
                    }

                });
            },
            closePopup() {
                let overlay = this.map.getOverlayById('info')
                overlay.setPosition(undefined)
                this.$refs.popupContent.innerHTML = ''
            },
            gotoFeature(feature) {
                this.map.getView().animate({
                    center: feature.getGeometry().getCoordinates(),
                    zoom: 15,
                    duration: 500,
                });
            },
            hasLegend(layer) {
                return layer.getSource() instanceof TileWMS
            },
            legendUrl(layer) {
                if (this.hasLegend(layer)) {
                    return layer
                        .getSource()
                        .getLegendUrl(this.map.getView().getResolution(), {
                            LEGEND_OPTIONS: 'forceLabels:on'
                        })
                }
            }
        };
    });
});