// IMPORTAR LOS COMPONENTES AQUI
import CategoryMaster from './components/Categories/master';
import CategoryIndex from './components/Categories/index';
import CategoryAdd from './components/Categories/add';
import CategoryEdit from './components/Categories/edit';

// IMPORTAR LAS CATEGORIAS AQUI
import TemplateMaster from './components/Templates/master';
import TemplateIndex from './components/Templates/index';
import TemplateAdd from './components/Templates/add';
import TemplateEdit from './components/Templates/edit';

// IMPORTAR LOS PRODUCTOS AQUI
import ProductMaster from './components/Products/master';
import ProductIndex from './components/Products/index';
import ProductAdd from './components/Products/add';
import ProductEdit from './components/Products/edit';

export default [{
    path: '/admin/categories',
    component: CategoryMaster,
    children: [{
        path: '',
        name: 'categories',
        components: {
            categoriesRouterView: CategoryIndex
        }
    }, {
        path: 'add',
        name: 'categoryAdd',
        components: {
            categoriesRouterView: CategoryAdd
        }
    }, {
        path: 'edit/:id',
        name: 'categoryEdit',
        components: {
            categoriesRouterView: CategoryEdit
        }
    }]
}, {
    path: '/admin/templates',
    component: TemplateMaster,
    children: [{
        path: '',
        name: 'templates',
        components: {
            templatesRouterView: TemplateIndex
        }
    }, {
        path: 'add',
        name: 'templateAdd',
        components: {
            templatesRouterView: TemplateAdd
        }
    }, {
        path: 'edit/:id',
        name: 'templateEdit',
        components: {
            templatesRouterView: TemplateEdit
        }
    }]
}, {
    path: '/admin/products',
    component: ProductMaster,
    children: [{
        path: '',
        name: 'products',
        components: {
            productsRouterView: ProductIndex
        }
    }, {
        path: 'add',
        name: 'productAdd',
        components: {
            productsRouterView: ProductAdd
        }
    }, {
        path: 'edit/:id',
        name: 'productEdit',
        components: {
            productsRouterView: ProductEdit
        }
    }]
}];
