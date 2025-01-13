import axios from "axios"

class PropertyManager {
    searchProperties(params) {
        return axios.get('/api/properties/search', { params })
    }
}

export default new PropertyManager()