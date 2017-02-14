@extends('layout')

@section('css')
  <!-- Datatables CSS -->
  <link rel="stylesheet" type="text/css" href="{{asset('vendor/plugins/datatables/media/css/dataTables.bootstrap.css')}}">

  <!-- Datatables Editor Addon CSS -->
  <link rel="stylesheet" type="text/css" href="{{asset('vendor/plugins/datatables/extensions/Editor/css/dataTables.editor.css')}}">
  <!-- Datatables ColReorder Addon CSS -->
  <link rel="stylesheet" type="text/css" href="{{asset('vendor/plugins/datatables/extensions/ColReorder/css/dataTables.colReorder.min.css')}}">
@endsection

@section('content')
  @if(Session::has('flash_message'))
       <div class="alert alert-success fade in">
           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
           {{ Session::get('flash_message') }}
       </div>
   @endif
  <h1>Liste des projets</h1>
  <table class="table table-bordered text-center">
    <thead>
      <tr>
        <th>Photo</th>
        <th>Titre</th>
        <th>Description</th>
        <th>Catégorie</th>
        <th>Video</th>
        <th>Visible</th>
        <th>Date de modification</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($projets as $key => $projet)
        <tr>
          <td><img src="{{ $projet->images['url'] }}" alt="{{ $projet->titre }}" width="100px"></td>
          <td>{{ $projet->titre }}</td>
          <td class="text-left">{!! $projet->description !!}</td>
          <td>{{ $projet->categories->name }}</td>
          <td>
            @if (!is_null($projet->video))
              <p class="hidden">1</p><!-- pour trier les photos -->
              <a href="{{ $projet->video }}" target="_blank"><i class="fa fa-film text-primary"></i></a>
            @else
              <p class="hidden">0</p><!-- pour trier les photos -->
              <i class="fa fa-times text-danger"></i>
            @endif
          </td>
          <td>
            @if($projet->active == 1)
              <p class="hidden">1</p><!-- pour trier les photos -->
              <i class="fa fa-check text-success"></i>
            @else
              <p class="hidden">0</p><!-- pour trier les photos -->
              <i class="fa fa-times text-danger"></i>
            @endif
          </td>
          <td>{{ Carbon\Carbon::parse($projet->updated_at)->format("d/m/y H:m") }}</td>
          <td>
            <a href="{{ route('work.update', ['id' => $projet['id']]) }}" class="btn btn-xs btn-warning">
              <i class="fa fa-pencil"></i> Editer
            </a>
            <a href="{{ route('work.remove', ['id' => $projet['id']]) }}" class="btn btn-xs btn-danger delete" >
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
  <script src="{{ asset('dist/index.min.js') }}"></script>
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
        return confirm("Attention, supprimer un projet est irréversible. Veux-tu réellement supprimer ce projet ?");
      });
    })
  </script>
@endsection
