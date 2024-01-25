<style>
    .container {
        width: 752px;
        height: 1050px;
        margin: 0 auto;

        padding: 10px 40px;
        position: relative;
    }

    .image_block {
        margin: 10px;
    }
</style>
<div class="container">
    @foreach($data as $image)
        <div class="image_block">
            <img src="{{$image}}" alt="document_image">
        </div>
    @endforeach
</div>
