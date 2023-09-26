const { defineConfig } = require("@vue/cli-service");
module.exports = defineConfig({
  transpileDependencies: true,
  runtimeCompiler: true,
  css: {
    loaderOptions: {
      sass: {
        additionalData: `
           @import "./src/assets/scss/main.scss";
        `,
      },
    },
  },
  publicPath: process.env.NODE_ENV === "production" ? "/chd103/g5" : "/",
  // outputDir: "mrt",
});
