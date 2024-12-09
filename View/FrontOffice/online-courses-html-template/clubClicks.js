// clubClicks.js

function incrementClubClicks(id_club) {
    fetch('incrementClicks.php?id_club=' + id_club)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            
            
        })
        .catch(error => console.error('There was a problem with the fetch operation:', error));
}

