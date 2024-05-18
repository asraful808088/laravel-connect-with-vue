export default function TokenExtrator(){
    const cookies = document.cookie.split(';').reduce((cookies, cookieString) => {
        const [name, value] = cookieString.split('=').map((c) => c.trim())
        cookies[name] = decodeURIComponent(value)
        return cookies
      }, {})
    return cookies
}