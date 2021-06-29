// IMPORTAR LOS COMPONENTES AQUI
import CategoryMaster from './components/Categories/master';
import CategoryIndex from './components/Categories/index';
import CategoryAdd from './components/Categories/add';
import CategoryEdit from './components/Categories/edit';

// IMPORTAR LAS CATEGORIAS AQUI
import TemplateMaster from './components/templates/master';
import TemplateIndex from './components/templates/index';
import TemplateAdd from './components/templates/add';
import TemplateEdit from './components/templates/edit';

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
}];
