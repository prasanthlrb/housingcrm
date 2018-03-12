@extends('include.layout')

@section('body')


<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Document
        <small>Section</small>
        @foreach($folder as $der)

        @if(Request::segment(2) == $der->id)
        {{$der->parent_id}}
          

        @endif
        @endforeach
      </h1>

    </section>

    <!-- Main content -->
    <section class="content container-fluid">

    <!-- Trigger the modal with a button -->

<button type="button" class="btn bg-purple" id="add_sec"><i class="fa fa-plus" aria-hidden="true"></i> Add Directory </button>
<button type="button" class="btn bg-purple" id="add"><i class="fa fa-plus" aria-hidden="true"></i> Add Files</button>

<div class="form-padding"></div>

<!-- Modal -->
<div id="product-model" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="border-cor modal-content">
      <div class="modal-header">
         <form class="form-horizontal"  action="/docs" method="post" id="product_form">
            {{csrf_field()}}
          <div id="update-fie"></div>
        <button type="button" class="close close1" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
          <div id="add-doc-messages"></div>
<input type="hidden" name="id" id="doc_id">
@if(Request::segment(2) == '')
<input type="hidden" name="parent" value="0">
@else
<input type="hidden" name="parent" value="{{Request::segment(2)}}">
@endif

          <div class="form-group form-padding">
      <label for="inputEmail" class="col-sm-3 control-label">Document Name:</label>
      <div class="col-sm-7">
         <input type="text" class="form-control" id="docname" name="docname">
      </div>
    </div>
<br>
<br>

      <div class="form-group form-padding">
      <label for="inputEmail" class="col-sm-3 control-label">Document URL:</label>
      <div class="col-sm-7">
       <input type="text" class="form-control" id="docurl" name="docurl">
      </div>
    </div>

<br>
<br>


    <div class="form-group form-padding">
      <label for="select" class="col-sm-3 control-label">Select Doc Type</label>
      <div class="col-sm-7">
        <select class="form-control" id="doctype" name="doctype">
            <option value="0">~Select Doc Type~</option>
          <option value="1">Word</option>
        <option value="2">Excel</option>
        <option value="3">Pdf</option>
        </select>

      </div>
    </div>


<br>
<br>



      <div class="form-group">
  <label for="comment">Notes About Douments:</label>
  <textarea class="form-control" rows="8" id="remark" name="remark"></textarea>
</div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success pull-right save-type" onclick="save()">Save</button>
        <button type="button" class="btn btn-default pull-left close1" data-dismiss="modal">Close</button>
      </div>
    </div>
</form>
  </div>
</div><!-- Modal -->




<div id="product-model2" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="border-cor modal-content">
      <div class="modal-header">
         <form class="form-horizontal"  action="/folder" method="post" id="product_form2">
            {{csrf_field()}}
          <div id="update-fie"></div>
        <button type="button" class="close close1" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
          <div id="add-doc-messages"></div>
<input type="hidden" name="id" id="doc_id">
          <div class="form-group form-padding">
      <label for="inputEmail" class="col-sm-3 control-label">Folder Name:</label>
      <div class="col-sm-8">
         <input type="text" class="form-control" id="folder" name="folder">

          @if(Request::segment(2) == '')
             <input type="hidden" class="form-control" id="parent" name="parent" value="0">
         @else
            <input type="hidden" class="form-control" id="parent" name="parent" value="{{Request::segment(2)}}">
           @endif

      </div>
    </div>
<br>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success pull-right save-type" onclick="save2()">Save</button>
        <button type="button" class="btn btn-default pull-left close1" data-dismiss="modal">Close</button>
      </div>
    </div>
</form>
  </div>
</div>



<div class="row">
  <div class="col-md-12">
     <div class="box">
            <div class="box-header">
              <ol class="breadcrumb">
                <li><a href="/docs"><i class="fa fa-dashboard"></i> Main Directory</a></li>
                <li class="active"><a href="/docs">Here</a></li>

              </ol>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

 <table id="myTable" class="table table-striped table-bordered doc_table" cellspacing="0" width="100%">
         <thead>
                <tr>
                   <th>S_No</th>
                    <th>File-Name</th>
                     <th>Create At</th>
                      <th>File-Type</th>
                    <th>Commend</th>
                    <th>Action</th>
                    </tr>
            </thead>


                <?php $x=1 ?>
               @foreach($folder as $fol)
                 @if($fol->parent_id == Request::segment(2))
               <tr>

            <td>{{$x}}</td>
            <td>{{$fol->folder_name}}</td>
            <td>{{$fol->created_at->diffForHumans()}}</td>
            <td>Directory</td>
            <td>Nothing</td>
              <th><a href="/folder/{{$fol->id}}">Open</a></th>

          </tr>
          <?php $x++ ?>
          @elseif(Request::segment(2) == '' AND $fol->parent_id == 0)
          <tr>

       <td>{{$x}}</td>
       <td>{{$fol->folder_name}}</td>
       <td>{{$fol->created_at->diffForHumans()}}</td>
       <td>Directory</td>
       <td>Nothing</td>
         <th><a href="/folder/{{$fol->id}}">Open</a></th>

     </tr>
     <?php $x++ ?>
             @endif
          @endforeach

           @foreach($docs as $document)
            @if($document->parent_id == Request::segment(2))
            <tr>
            <td width="5%">{{$x}}</td>
             <td>{{$document->docname}}</td>
              <td>{{$document->created_at->diffForHumans()}}</td>
              @if($document->doctype == 1)
              <td width="10%"> <i class="fa fa-file-word-o fa-2x centered-align" aria-hidden="true"></i></td>
              @elseif($document->doctype == 2)
               <td width="10%"><i class="fa fa-file-excel-o fa-2x centered-align" aria-hidden="true"></i></td>
               @else
               <td width="10%"><i class="fa fa-file-pdf-o fa-2x centered-align" aria-hidden="true"></i></td>
               @endif

                <td width="30%"><p style="font-family: sans-serif; text-align: justify;">{{$document->remark}}</p></td>
               <td width="12%">



  <div class="btn-group">
                  <button type="button" class="btn bg-purple">Action</button>
                  <button type="button" class="btn bg-purple dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a target="_blank" href="{{$document->docurl}}">Open</a></li>

                    <li><a href="#" id="edit-btn" onclick="edit_doc({{$document->id}})">Edit</a></li>
                    <li><a href="#" id="edit-btn" onclick="delete_doc({{$document->id}})">Delete</a></li>

                    <li> {{csrf_field()}}

                    </li>

                  </ul>
                </div>
                </td>
      </tr>
        <?php $x++?>
          @elseif(Request::segment(2) == '' AND $document->parent_id == 0)
            <tr>
            <td width="5%">{{$x}}</td>
             <td>{{$document->docname}}</td>
              <td>{{$document->created_at->diffForHumans()}}</td>
              @if($document->doctype == 1)
              <td width="10%"> <i class="fa fa-file-word-o fa-2x centered-align" aria-hidden="true"></i></td>
              @elseif($document->doctype == 2)
               <td width="10%"><i class="fa fa-file-excel-o fa-2x centered-align" aria-hidden="true"></i></td>
               @else
               <td width="10%"><i class="fa fa-file-pdf-o fa-2x centered-align" aria-hidden="true"></i></td>
               @endif

                <td width="30%"><p style="font-family: sans-serif; text-align: justify;">{{$document->remark}}</p></td>
               <td width="12%">



  <div class="btn-group">
                  <button type="button" class="btn bg-purple">Action</button>
                  <button type="button" class="btn bg-purple dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a target="_blank" href="{{$document->docurl}}">Open</a></li>

                    <li><a href="#" id="edit-btn" onclick="edit_doc({{$document->id}})">Edit</a></li>
                    <li><a href="#" id="edit-btn" onclick="delete_doc({{$document->id}})">Delete</a></li>

                    <li> {{csrf_field()}}

                    </li>

                  </ul>
                </div>
                </td>
      </tr>
        <?php $x++?>
         @endif
  @endforeach


</table>

</div>
</div>

</div>
</div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

 @endsection
