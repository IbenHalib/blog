<?php
namespace Vadim\BlogBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class ArticleAdmin extends Admin
{

// Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('title', 'text', array('label' => 'Post Title'))
            ->add('category', 'entity', array('class' => 'Vadim\BlogBundle\Entity\Tag'))
            ->add('body') //if no type is specified, SonataAdminBundle tries to guess it
        ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('title')
//            ->add('author')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('title')
            ->add('created')
//            ->add('author')
        ;
    }

//    /**
//     * Конфигурация отображения записи
//     *
//     * @param \Sonata\AdminBundle\Show\ShowMapper $showMapper
//     * @return void
//     */
//    protected function configureShowField(ShowMapper $showMapper)
//    {
//        $showMapper
//            ->add('id', null, array('label' => 'Идентификатор'))
//            ->add('title', null, array('label' => 'Заголовок'))
//            ->add('body', null, array('label' => 'Анонс'))
//            ->add('numberOfViews', null, array('label' => 'Кількість переглядів'))
//            ->add('created', null, array('label' => 'Дата публикации'))
//            ->add('tags', null, array('label' => 'теги'))
//            ->add('category', null, array('label' => 'категорія'));
//    }
//
//
//    /**
//     * Конфигурация формы редактирования записи
//     * @param \Sonata\AdminBundle\Form\FormMapper $formMapper
//     * @return void
//     */
//    protected function configureFormFields(FormMapper $formMapper)
//    {
//        $formMapper
//            ->add('id', null, array('label' => 'Идентификатор'))
//            ->add('title', null, array('label' => 'Заголовок'))
//            ->add('body', null, array('label' => 'Анонс'))
//            ->add('numberOfViews', null, array('label' => 'Кількість переглядів'))
//            ->add('created', null, array('label' => 'Дата публикации'))
//
//            //by_reference используется для того чтобы при трансформации данных запроса в объект сущности
//            //которую выполняет Symfony Form Framework, использовался setter сущности News::setNewsLinks
//            ->add('newsCategoty', 'sonata_type_collection',
//                array('label' => 'Ссылки', 'by_reference' => false),
//                array(
//                    'edit' => 'inline',
//                    //В сущности NewsLink есть поле pos, отражающее положение ссылки в списке
//                    //указание опции sortable позволяет менять положение ссылок в списке перетаскиваением
//                    'sortable' => 'pos',
//                    'inline' => 'table',
//                ))
//            ->add('newsCategory', null, array('label' => 'Категория'))
//            ->setHelps(array(
//                    'title' => 'Подсказка по заголовку',
//                    'pubDate' => 'Дата публикации новости на сайте'
//                ));
//    }
//
//    /**
//     * Конфигурация списка записей
//     *
//     * @param \Sonata\AdminBundle\Datagrid\ListMapper $listMapper
//     * @return void
//     */
//    protected function configureListFields(ListMapper $listMapper)
//    {
//        $listMapper
//            ->addIdentifier('id')
//            ->addIdentifier('title', null, array('label' => 'Заголовок'))
//            ->add('pubDate', null, array('label' => 'Дата публикации'))
//            ->add('newsCategory', null, array('label' => 'Категория'));
//    }
//
//    /**
//     * Поля, по которым производится поиск в списке записей
//     *
//     * @param \Sonata\AdminBundle\Datagrid\DatagridMapper $datagridMapper
//     * @return void
//     */
//    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
//    {
//        $datagridMapper
//            ->add('title', null, array('label' => 'Заголовок'));
//    }
//
//    /**
//     * Конфигурация левого меню при отображении и редатировании записи
//     *
//     * @param \Knp\Menu\ItemInterface $menu
//     * @param $action
//     * @param null|\Sonata\AdminBundle\Admin\Admin $childAdmin
//     *
//     * @return void
//     */
//    protected function configureSideMenu(MenuItemInterface $menu, $action, Admin $childAdmin = null)
//    {
//        $menu->addChild(
//            $action == 'edit' ? 'Просмотр новости' : 'Редактирование новости',
//            array('uri' => $this->generateUrl(
//                    $action == 'edit' ? 'show' : 'edit', array('id' => $this->getRequest()->get('id'))))
//        );
//    }
}
