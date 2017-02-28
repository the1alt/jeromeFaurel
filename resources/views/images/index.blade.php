@extends('layout')

@section('css')
  <!-- Datatables CSS -->
  <link rel="stylesheet" type="text/css" href="{{asset('dist/index.min.css')}}">
@endsection

@section('content')
  @if(Session::has('flash_message'))
       <div class="alert alert-success fade in">
           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
           {{ Session::get('flash_message') }}
       </div>
   @endif
  <h1>Liste des images</h1>
  <table class="table table-bordered text-center">
    <thead>
      <tr>
        <th>Image</th>
        <th>Titre</th>
        <th>Utilisée</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($images as $image)
        <tr>
          <td>
            <p class="hidden">{{ $image->id }}</p><!-- pour trier les images -->
            <img src="{{ $image->url }}" alt="{{ $image->name }}" width="120px"></td>
          <td><h3>{{ $image->name }}</h3></td>
          <td>
            @if(count($image->projets) > 0)
              <p class="hidden">1</p><!-- pour trier les images -->
              <i class="fa fa-check text-success"></i>
            @else
              <p class="hidden">0</p><!-- pour trier les images -->
              <i class="fa fa-times text-danger"></i>
            @endif
          </td>
          <td>
            <a href="{{ route('images.remove', ['id' => $image['id']]) }}" class="btn btn-xs btn-danger delete" >
              <i class="fa fa-trash"></i> supprimer
            </a>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>

@endsection

@section('js')
  @parent
  <script src="{{ asset('dist/index.min.js')}}"></script>
  <script type="text/javascript">

    $(document).ready(function(){
      $('.table').dataTable({
          "aoColumnDefs": [{
            'bSortable': false,
            'aTargets': [-1]
          }],
          "oLanguage": {
            "oPaginate": {
              "sPrevious": "",
              "sNext": ""
            }
          },
          "iDisplayLength": 10,
          "aLengthMenu": [
            [5, 10, 25, 50, -1],
            [5, 10, 25, 50, "All"]
          ],
          "sDom": '<"dt-panelmenu clearfix"lfr>t<"dt-panelfooter clearfix"ip>',
          "oTableTools": {
            "sSwfPath": "../dist/swf/copy_csv_xls_pdf.swf"
          }
        });
      $('.delete').on("click", function(){
        return confirm("Attention, supprimer une image est irréversible. Veux-tu réellement supprimer cette image ?");
      })
    });
  </script>
@endsection
