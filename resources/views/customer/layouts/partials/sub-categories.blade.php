

<section class="sidebar-nav-sub-wrapper">

    <section class="sidebar-nav-sub-item">

    @foreach($category->children as $subCategory)

        <span class="sidebar-nav-sub-item-title"><a href="#">{{$subCategory->name}}</a><i class="fa fa-angle-left"></i></span>

    @endforeach    
    
    </section>

</section>



