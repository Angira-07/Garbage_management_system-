document.addEventListener("DOMContentLoaded", function () {
    // Center of West Bengal with suitable zoom
    const map = L.map('map').setView([22.9786, 87.7470], 7); // Zoom 7 shows only West Bengal region

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    // Define custom icon
    const dustbinIcon = L.icon({
        iconUrl: '../photos/dustbin-pin.png',
        iconSize: [32, 32],       // width, height
        iconAnchor: [16, 32],     // point of the icon which will correspond to marker's location
        popupAnchor: [0, -32]     // point from which the popup should open
    });

    fetch("../main/get_dustbin.php")
        .then(response => response.json())
        .then(data => {
            data.forEach(dustbin => {
                if (dustbin.latitude && dustbin.longitude) {
                    L.marker([dustbin.latitude, dustbin.longitude], { icon: dustbinIcon })
                        .addTo(map)
                        .bindPopup(`Dustbin ID: ${dustbin.id}`);
                }
            });
        })
        .catch(error => {
            console.error("Error loading dustbin locations:", error);
        });
});
