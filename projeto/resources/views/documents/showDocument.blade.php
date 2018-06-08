<!DOCTYPE html>
<html>
<head>
    @include('partials.index.top') 
    <title>Personal Finances App</title>
</head>
<body>
    @include('partials.index.nav')
    
    
    <table class="table table-striped">
        
        <thead>
            <tr>
                <th>Document</th>                    
                <th>Description</th>
                <th>Movement</th>
               
            </tr>
        </thead>

        <tbody>
           
            <tr>
                <td><img class="profiles" src="{{ $doc->getDoc() }}"></td>
                <td>{{ $doc->description }}</td>
                <td>{{ $doc->movements }}</td>
            </tr>
       
        </tbody>
    </table>




</body>
</html>