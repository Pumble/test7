// IMPORTAR LOS COMPONENTES AQUI
import CategoryMaster from './components/Categories/master';
import CategoryIndex from './components/Categories/index';
import CategoryAdd from './components/Categories/add';
import CategoryEdit from './components/Categories/edit';

export default [{
    path: '/categories',
    component: CategoryMaster,
    children: [{
        path: '/',
        name: 'categories',
        components: {
            categoriesRouterView: CategoryIndex
        }
    }, {
        path: '/add',
        name: 'categoryAdd',
        components: {
            categoriesRouterView: CategoryAdd
        }
    }, {
        path: '/edit/:id',
        name: 'categoryEdit',
        components: {
            categoriesRouterView: CategoryEdit
        }
    }]
}];
