import Vue from "vue";
import VueRouter from "vue-router";
import Home from "./pages/Home.vue";
import Restaurant from "./pages/Restaurant.vue";
import CheckOut from "./pages/CheckOut.vue";
import NotFound from "./pages/NotFound.vue";
import AboutUs from "./pages/AboutUs.vue";

Vue.use(VueRouter);

// Routes definition

const router = new VueRouter({
    mode: "history",
    linkExactActiveClass: "active",
    scrollBehavior (to, from, savedPosition) {
        return { x: 0, y: 0, behavior: 'smooth' }
    },
    routes: [
        {
            path: "/",
            name: "home",
            component: Home
        },
        {
            path: "/restaurant/:slug",
            name: "restaurant",
            component: Restaurant
        },
        {
            path: "/checkout/",
            name: "checkout",
            component: CheckOut
        },
        {
            path: "/chisiamo/",
            name: "aboutus",
            component: AboutUs
        },
        {
            path: "*",
            component: NotFound
        }
    ]
});

export default router;
