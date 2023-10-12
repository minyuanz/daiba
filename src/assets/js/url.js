export default {
    install: (app, options) => {
      // inject a globally available $translate() method
      app.config.globalProperties.$imgUrl = (url) => {
        return `${process.env.VUE_APP_IMG_URL}${url}`
      }

      app.config.globalProperties.$apiUrl = (url) => {
        return `${process.env.VUE_APP_API_URL}${url}`
      }
    }
  }