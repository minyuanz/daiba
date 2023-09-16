<template>
    <footer :class="{ '--closeFooter': shouldclose }">
        <div class="footerLogo">
            <router-link to="/">
                <img src="../../public/img/logo.png" alt="" />
            </router-link>
        </div>
        <div class="footerTxt">
            <p>E-mail : daibason@gmail.com</p>
            <p>本網站為緯育CHD103期展示作品，非商業用途。</p>
        </div>
    </footer>
</template>


<script>
export default {
    computed: {
        shouldclose() {
            // 根據路由的 meta.useAppLayout 屬性來決定是否使用 App.vue 佈局
            return this.$route.path === "/";
        },
    },
};
</script>