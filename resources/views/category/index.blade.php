@php /** @var \App\Models\Category $category */ @endphp
<x-header title="{{  $category->name }}"/>
<x-grid.big-product-grid :products="$products"/>