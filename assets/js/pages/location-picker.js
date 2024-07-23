document.addEventListener('DOMContentLoaded', function () {
  const mapElement = document.getElementById('map');
  const locationPicker = new LocationPicker(mapElement, {
      setCurrentPosition: true,
  });

  // You can now use locationPicker to interact with the location picker.
  // For example: locationPicker.getMarkerPosition(), locationPicker.setLocation(lat, lng), locationPicker.setCurrentPosition(), etc.
});
