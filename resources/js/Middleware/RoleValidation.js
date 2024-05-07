import UserData from "../services/UserData"

export default (role) => {
    return (to, from, next) => {
        if (UserData.role == role) {
            next()
        } else {
            next({ name: 'AppIndex' })
        }
    }
} 