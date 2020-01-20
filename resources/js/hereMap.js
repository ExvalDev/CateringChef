var platform = new H.service.Platform({
  'apikey': 'dzpjBMch4PbCH5w8XkgOrWMGPjRhTQ6v8QwsGeVdgyg'
});
// Obtain the default map types from the platform object:
var defaultLayers = platform.createDefaultLayers();

// Instantiate (and display) a map object:
var map = new H.Map(
  document.getElementById('mapContainer'),
  defaultLayers.vector.normal.map,
  {
  zoom: 10,
  center: { lat: 52.5, lng: 13.4 },
  engineType: H.map.render.RenderEngine.EngineType.P2D
  });