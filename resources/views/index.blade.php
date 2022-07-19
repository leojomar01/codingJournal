@extends('layout')

@section('content')






<style>
    
    .action{
        display: flex;
        gap:1rem;
        justify-content: center;
        align-items: center;
    }
    textarea{
        height: 5em;
        resize: none;
    }
    td{
        height: 10.6em;
    }
</style>
@if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
@endif

@foreach($titles as $title)

<div class="card p-5 m-5">
 <form action="{{route('todos.store')}}" method="post">
    @csrf
        <h5 class="p-3">{{$title}}</h5>
        <div class='mb-3 '>
            <div class="form-group row p-3" >
                <label class="col col-3 mb-3 form-label" for="date">Date</label>
                <input class="form-control col" type="date" name="date" id="date" >
                <input type="hidden" name="group_name" id="group_name" value="{{$title}}">
            </div>
        </div>
        <div class='row m-3'>
            <textarea class=" form-control" name="data" id="data" cols="30" rows="3" placeholder="{{$title}}" ></textarea>
        </div>
        <div class='row m-3'>
            <button class="btn btn-primary" type="submit">Save</button>
        </div>
 </form>
    

        <div class="container">
            <table class="table">
                <thead>
                    <tr>
                        <th>{{$title}}</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

            <?php 
            if(count($$title)==0){
            ?>
                <td><td colspan="2">No Records Found</td></td>
            <?php
            }
            ?>
            @foreach($$title as $data )
           
                    <tr>
                        <td class="data">
                            <form class="" action="{{route('todos.update',$data->id)}}" method="post">
                                @csrf
                                @method('PATCH')
                                <label for="date">Date: </label>
                                <input type="date" class="editdate mb-2" name="date" id="date" value="{{$data->date}}" readonly>
                                <textarea class="form-control editdata mb-2" name="data" id="data" cols="30" rows="3" readonly>{{$data->data}}</textarea>

                                <button class="btn btn-success" type="submit" name="update" id="update" style="visibility: hidden;">Update</button>
                                <button class="btn btn-dark" type="button" name="cancel" id="cancel" style="visibility: hidden;">Cancel</button>
                            </form>
                        </td>
                        <td class="action">
                            <button class="btn btn-success" id="edit">Edit</button>
                            <form action="{{route('todos.destroy',$data->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <input type="submit" name="delete" value="Delete" onclick="return confirm('Are you sure you want to delete this record?')" class="btn btn-danger">
                        </form>
                        </td>
                    </tr>
            @endforeach
                </tbody>
            </table>
        </div>
</div>

@endforeach


<script>
    let btnEdit =document.querySelectorAll('#edit');
    let btnCancel =document.querySelectorAll('#cancel');
    let btnUpdate =document.querySelectorAll('#update');
    let data = document.querySelectorAll('.editdata')
    let date = document.querySelectorAll('.editdate')
    
    for(let i = 0; i<btnEdit.length;i++){
        btnEdit[i].onclick = function(){
            data[i].readOnly = false;
            date[i].readOnly = false;
            btnUpdate[i].style.visibility='visible';
            btnCancel[i].style.visibility='visible';
        }
    }

    for(let i = 0; i<btnCancel.length;i++){
        btnCancel[i].onclick = function(){
            data[i].readOnly = true;
            date[i].readOnly = true;
            btnUpdate[i].style.visibility='hidden';
            btnCancel[i].style.visibility='hidden';
        }
    }
</script>
    
@endsection