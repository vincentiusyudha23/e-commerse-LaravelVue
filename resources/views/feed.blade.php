{!! '<'.'?xml version="1.0"?>' !!}

<rss version="2.0" xmlns:g="http://base.google.com/ns/1.0">

    <channel>
        <title>Vincentius E-commerce</title> 
        <link>{{ route('home') }}</link> 
        <description>A description of your content</description> 
    
        @foreach ($products as $product)
            <item> 
                <g:id>{{ $product->id }}</g:id>
                <title>{{ $product->name}}</title>
                <link>{{ route('home') }}</link>
                <description>Ini Hanya Testing</description>
                <g:image_link>
                  {{ route('home') }}/storage/{{ $product->url_img }}
                </g:image_link> 
                <g:price>{{ $product->price }} IDR</g:price> 
                <g:availability>
                    @if ($product->stock > 0)
                        in_stock
                    @else
                        out_of_stock
                    @endif    
                </g:availability> 
                <g:brand>TheVins</g:brand>   
                <g:update_type>merge</g:update_type> 
            </item>
        @endforeach
    </channel> 
</rss>