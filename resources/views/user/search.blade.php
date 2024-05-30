@extends('user.layouts.app')
@extends('user.index', ['lessons' => $lessons])
@section('search')
{{-- <div class="tab search-form-container ml-5">
    <input type="text" id="myInput" onkeyup="searchKeyUp()" onclick="showList()" placeholder="Search for names..">
    <ul id="myUL">
        <li style="display:none"><a href="#">Adele</a></li>
        <li style="display:none"><a href="#">Agnes</a></li>

        <li style="display:none"><a href="#">Billy</a></li>
        <li style="display:none"><a href="#">Bob</a></li>

        <li style="display:none"><a href="#">Calvin</a></li>
        <li style="display:none"><a href="#">Christina</a></li>
        <li style="display:none"><a href="#">Cindy</a></li>
    </ul>
</div>
<script>
    function showList() {
        var listItems = document.querySelectorAll('#myUL li');
        listItems.forEach(function(item) {
            item.style.display = 'block';
        });
    }

    function hideList() {
        var listItems = document.querySelectorAll('#myUL li');
        listItems.forEach(function(item) {
            item.style.display = 'none';
        });
    }

    function searchKeyUp() {
        var lessons = @json($lessons);
        var input = document.getElementById("myInput");
        var filter = input.value.toUpperCase();
        var listItems = document.querySelectorAll('#myUL li');

        listItems.forEach(function(item) {
            var a = item.getElementsByTagName("a")[0];
            var lessonName = a.text().toUpperCase() + " " + lessons[$(this).index()].name.toUpperCase();
            if (lessonName.indexOf(filter) > -1) {
                item.style.display = "";
            } else {
                item.style.display = "none";
            }
        });
    }

    // Add event listener to document for clicks
    document.addEventListener('click', function(event) {
        var searchZone = document.querySelector('.search-form-container');
        if (!searchZone.contains(event.target)) {
            hideList();
        }
    });
</script>
<style>
    #myInput {
        background-image: url('../assets/assets/img/loupe.png');
        /* Add a search icon to input */
        background-position: 15px 15px;
        /* Position the search icon */
        background-repeat: no-repeat;
        /* Do not repeat the icon image */
        width: 100%;
        /* Full-width */
        font-size: 16px;
        /* Increase font-size */
        padding: 12px 20px 12px 40px;
        /* Add some padding */
        border: 1px solid #ddd;
        border-radius: 20px;
        /* Add a grey border */
        margin-bottom: 4px;
        /* Add some space below the input */
    }

    #myUL {
        /* Remove default list styling */
        list-style-type: none;
        padding: 0;
        margin: 0;
    }

    #myUL li a {
        dis border: 1px solid #ddd;
        /* Add a border to all links */
        margin-top: -1px;
        /* Prevent double borders */
        background-color: #f6f6f6;
        /* Grey background color */
        padding: 12px;
        /* Add some padding */
        text-decoration: none;
        /* Remove default text underline */
        font-size: 18px;
        /* Increase the font-size */
        color: black;
        /* Add a black text color */
        display: block;
        /* Make it into a block element to fill the whole list */
    }

    #myUL li a:hover:not(.header) {
        background-color: #eee;
        /* Add a hover effect to all links, except for headers */
    }
</style> --}}
@endsection