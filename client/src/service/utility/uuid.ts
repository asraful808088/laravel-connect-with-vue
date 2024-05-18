export default function generateUniqueId(length = 60) {
  const characters = `ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789${Date.now() + Date.now()}`
  let result = ''
  const charactersLength = characters.length

  for (let i = 0; i < length; i++) {
    result += characters.charAt(Math.floor(Math.random() * charactersLength))
  }

  return result
}
