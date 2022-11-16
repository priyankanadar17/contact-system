
<div class="container">
    
    @if(!$link)
    <form action="{{ url('share/'.$key) }}" method="POST">
        @csrf
        <br>
        <input type="hidden" name="key" value="{{$key}}">
        <input type="datetime-local" placeholder="Enter date and time" name="datetime"/>
        <button type="submit" >Done</button><br><br>
        <div>  
            @if(Session::has('alert'))
            {{ session()->get('alert') }}
        @endif
        </div>
    </form>
    @else
    <p>{{$link}}</p>
    @endif
</div>

<script>
</script>