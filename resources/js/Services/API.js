import axios from 'axios'
import UserToken from './UserToken'

const API = axios.create({
  baseURL: `http://localhost:8000/api`,
  headers: {
    "Content-Type": "application/x-www-form-urlencoded",
    "Access-Control-Allow-Origin": "*",
    "Access-Control-Allow-Headers": "*",
    "X-Requested-With": "XMLHttpRequest",
    "Authorization": 'Bearer ' + UserToken
  }
})

export default () => {
  return API
}
