import Products from "./components/Products/Products";
import MainPage from "./components/MainPage/MainPage";
import NotFoundPage from "./components/NotFoundPage/NotFoundPage";

const routes = [];

routes.push(
    {
        path: '/products',
        component: Products,
        exact: true,
    },
    {
        path: '/',
        component: MainPage,
        exact: true,
    }
);

// Static
routes.push({
    component: NotFoundPage,
});

export {routes}
