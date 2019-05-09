<p class="tags d-flex flex-wrap">
    @foreach($recipe->tags as $tag)
        <span class="tag-style">{{ $tag->title }}</span>
    @endforeach
</p>
