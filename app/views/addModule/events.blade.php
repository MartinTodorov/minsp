@extends('layout.main')

@section('content')
@if(Auth::check())
<p>Hello , {{ Auth::user()->real_name }} </p>
<form method="post" action="{{URL::route('add-events-post')}}" enctype="multipart/form-data">
    Event name:<input type="text" name="name"{{ (Input::old('name')) ? ' value="' .e(Input::old('name')). '"' : ''  }}>
    @if($errors->has('name'))
    {{ $errors->first('name') }}
    @endif
    <br>Category :<select name="evCat">
        <option value="1">Normal</option>
        <option value="2">Online music contest</option>
        <option value="3">World paid music event</option>
    </select>     
    <br>Country :<select name="country">
        <?php
        $countrys = Countries::getList();
        foreach ($countrys as $key) {           
            echo ' <option value="'.$key['country-code'].'">';
            echo $key['name'];
            echo '</option>';
        }
        ?>        
    </select>
    @if($errors->has('country'))
    {{ $errors->first('country') }}
    @endif
    <br>City :<input type="text" name="location"{{ (Input::old('location')) ? ' value="' .e(Input::old('location')). '"' : ''  }}>
    @if($errors->has('location'))
    {{ $errors->first('location') }}
    @endif
    <br>Genre :<select name="genre">
        <option value="1" class="genre">Rock</option>
        <option value="2" class="genre">Metal</option>
        <option value="3" class="genre">Jazz</option>
        <option value="4" class="genre">Reggae</option>
        <option value="5" class="genre">Еlectronic music</option>
        <option value="6" class="genre">Classic</option>
        <option value="7" class="new_genre" data-clicked="no">Other</option>
    </select>    
    <input type="text" id="other_genre" name="other_genre"{{ (Input::old('other_genre')) ? ' value="' .e(Input::old('other_genre')). '"' : ''  }}>
    <br>Description :<textarea name="description"{{ (Input::old('description')) ? ' value="' .e(Input::old('description')). '"' : ''  }}></textarea>    
    @if($errors->has('description'))
    {{ $errors->first('description') }}
    @endif<br>
    <br>Date :<input type="text" id="datepicker" name="date"{{ (Input::old('date')) ? ' value="' .e(Input::old('date')). '"' : ''  }}>
    @if($errors->has('date'))
    {{ $errors->first('date') }}
    @endif<br>
    <br>Avatar :<input type="file" name="avatar"{{ (Input::old('avatar')) ? ' value="' .e(Input::old('avatar')). '"' : ''  }}>
    @if($errors->has('avatar'))
    {{ $errors->first('avatar') }}
    @endif<br>
    <input type="submit" value="add band">
    {{Form::token()}}
</form>
@else
<p> You are not sign in. </p>
@endif
@stop