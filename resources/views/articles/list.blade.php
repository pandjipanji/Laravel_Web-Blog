
<div class="row">
        <h2 class="pull-left">List Articles</h2>
        {!! link_to(route("articles.create"), "Create", ["Class" => "pull-right btn btn-raised btn-primary"]) !!}
        {!! link_to(route("export_xls"), "Export Excel", ["Class" => "pull-right btn btn-raised btn-success", 'style' => "margin-right:10px;"]) !!}
</div>

@foreach($articles as $article)
<article class="row">
    <h1>{!! $article->title !!}</h1>
    <p>
        {!! str_limit($article->content, 250) !!}
        {!! link_to(route('articles.show', $article->id), 'Read More') !!}
    </p>
</article>
@endforeach
<div>
{{ $articles->render() }}
</div>