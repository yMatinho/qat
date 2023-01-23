<?php

namespace App\Controller;

use App\Form\CrudFormFactory;
use App\Form\Input\Composite\InputLeaf;
use App\Form\Input\Composite\LeafFactory;
use App\Form\Input\Text;
use App\Form\Input\Textarea;
use App\Model\Contact;
use App\Model\Product;
use Framework\DB\Query\Clausure\WhereClausure;
use Framework\DB\Query\Clausure\WhereComparison;
use Framework\Singleton\Page\Page;
use Framework\Singleton\Route\Route;

class ProductController
{
    public function __construct()
    {
    }

    public static function showCreate()
    {
        $leafFactory = new LeafFactory();
        $inputLeafs = [
            $leafFactory->makeLeaf((new Text("title", "Título"))),
            $leafFactory->makeLeaf((new Text("price", "Preço"))),
            $leafFactory->makeLeaf((new Textarea("description", "Descrição"))),
        ];
        $form = new CrudFormFactory("create_product", $inputLeafs, "post", Route::get()->route("product.store"), "Criar");

        return Page::get()->loadTemplate("crudKit.create", [
            "seoTitle" => "Criar Produto",
            "seoDescription" => "",
            "title" => "Criar Produto",
            "shortDescription" => "Lorem ipsum dolor sit amet",
            "formHtml" => $form->makeHtml()
        ]);
    }

    public static function showList()
    {
        return Page::get()->loadTemplate("product.list", [
            "seoTitle" => "Listar Produtos",
            "seoDescription" => "",
            "title" => "Lista de Produtos",
            "shortDescription" => "Lorem ipsum dolor sit amet",
            "tableRows" => self::tableRows()
        ]);
    }

    private static function tableRows()
    {
        //@TODO: Refactor and make an abstraction of how to make tables

        $tableRows = "[";
        foreach (Product::select([]) as $key => $item) {
            $tableRows .= "{
                items: [
                    {label: '" . $item['title'] . "', type: 'normal'},
                    {label: 'R$" . number_format($item['price'], 2, ",", ".") . "', type: 'normal'},
                ],
                actions: [
                        {route: '" . Route::get()->route('product.edit', ["product_id" => $item['id']]) . "', icon:'fas fa-pencil-alt', btnStyle: 'btn-info' },
                        
                        {route: '" . Route::get()->route('product.destroy') . "', type:'delete', delete_id_field_name:'product_id', csrf: '', delete_id:" . $item['id'] . " },
                ]
            },";
        }
        $tableRows .= "]";
        return $tableRows;
    }

    public static function showEdit()
    {
        $product = self::getProductFromUrlParam();

        $leafFactory = new LeafFactory();
        $inputLeafs = [
            $leafFactory->makeLeaf((new Text("title", "Título", value: $product['title']))),
            $leafFactory->makeLeaf((new Text("price", "Preço", value: $product["price"]))),
            $leafFactory->makeLeaf((new Textarea("description", "Descrição", value: $product['description']))),
        ];
        $form = new CrudFormFactory("update_product", $inputLeafs, "post", Route::get()->route("product.update"), "Salvar", ["product_id" => $product['id']]);

        return Page::get()->loadTemplate("crudKit.create", [
            "seoTitle" => "Editar Produto",
            "seoDescription" => "",
            "title" => "Editar Produto",
            "shortDescription" => "Lorem ipsum dolor sit amet",
            "formHtml" => $form->makeHtml()
        ]);
    }

    private static function getProductFromUrlParam()
    {
        if (!$_GET["product_id"])
            return Route::get()->redirect("404");

        $product = Product::find($_GET["product_id"]);
        if (!$product)
            return Route::get()->redirect("404");

        return $product;
    }

    public static function store()
    {
        $product = new Product();
        $product->title = $_POST['title'];
        $product->price = $_POST['price'];
        $product->description = $_POST['description'];

        $product->save();

        return Route::get()->redirect("product.list");
    }

    public static function update()
    {
        $product = new Product();
        $productData = Product::find(@$_POST['product_id']);
        if (empty($productData))
            return Route::get()->redirect("404");
        $product->id = $productData['id'];
        $product->title = $_POST['title'];
        $product->price = $_POST['price'];
        $product->description = $_POST['description'];

        $product->save();

        return Route::get()->redirect("product.list");
    }

    public static function destroy() {
        Product::delete($_POST['product_id']);

        return Route::get()->redirect("product.list");
    }
}
