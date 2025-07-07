const data = [
    { place: 'Monte grande', date: '2024-07-15', time: '19:00' },
    { place: 'esteban echeverria', date: '2024-07-16', time: '10:00' },
    { place: 'Lomas de zamora', date: '2024-07-17', time: '21:30' },
    { place: 'Jaguel', date: '2024-07-20', time: '18:00' },
    { place: 'Luis guillon', date: '2024-07-22', time: '15:30' },
    { place: 'La victoria', date: '2024-07-25', time: '20:00' },
    { place: '9 de abril', date: '2024-07-27', time: '19:45' },
    { place: 'plaza mitre', date: '2024-07-28', time: '09:00' },
    { place: 'temperley', date: '2024-07-30', time: '12:00' },
    { place: 'Nuestras malvinas', date: '2024-07-31', time: '14:00' }
];

const searchInput = document.getElementById('searchInput');
const resultsList = document.getElementById('resultsList');

function displayResults(items) {
    resultsList.innerHTML = ''; 
    if (items.length === 0) {
        resultsList.innerHTML = '<li class="list-item">No se encontraron resultados.</li>';
        return;
    }
    items.forEach(({ place, date, time }) => {
        const li = document.createElement('li');
        li.className = 'list-item';
        li.innerHTML = `<div class="place">${place}</div><div class="datetime">${date} · ${time}</div>`;
        resultsList.appendChild(li);
    });
}

function filterData(query) {
    const lowerQuery = query.toLowerCase();
    return data.filter(({ place, date, time }) => {
        return (
            place.toLowerCase().includes(lowerQuery) ||
            date.includes(lowerQuery) ||
            time.includes(lowerQuery)
        );
    });
}

searchInput.addEventListener('input', () => {
    const query = searchInput.value.trim();
    if (query === '') {
        displayResults(data);
    } else {
        const filtered = filterData(query);
        displayResults(filtered);
    }
});

displayResults(data);