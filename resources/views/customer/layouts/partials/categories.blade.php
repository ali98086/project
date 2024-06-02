
@foreach($categories as $category)

    <section class="sidebar-nav-item">

        <span class="sidebar-nav-item-title">{{$category->name}} <i class="fa fa-angle-left"></i></span>

        @include('customer.layouts.partials.sub-categories', ['category'=> $category])

    </section>

@endforeach    
