<div class="accordion" id="accordionExample">
    <div class="card">
        @foreach($functions as $function)
            <a href="#" onclick="window.location='{{ $f->func_urlrecurso }}'">{{ $f->func_nombre }}</a>
        @endforeach
    </div>
</div>
