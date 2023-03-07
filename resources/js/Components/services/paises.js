export default class CountryService {
    getCountries() {
        return fetch('data/paises.json').then(res => res.json())
            .then(d => d.data);
    }
}