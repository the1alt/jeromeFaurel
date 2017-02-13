@extends('layout')

@section('css')
  <!-- Datatables CSS -->
  <link rel="stylesheet" type="text/css" href="{{asset('vdist/index.min.css')}}">
@endsection

@section('content')
  @if(Session::has('flash_message'))
       <div class="alert alert-success fade in">
           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
           {{ Session::get('flash_message') }}
       </div>
   @endif
  <h1>Liste des photos</h1>
  <table class="table table-bordered text-center">
    <thead>
      <tr>
        <th>Photo</th>
        <th>Titre</th>
        <th>Description</th>
        <th>Video</th>
        <th>Visible</th>
        <th>Date de modification</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($photos as $key => $photo)
        <tr>
          <td><img src="{{ $photo->image }}" alt="{{ $photo->titre }}" width="100px"></td>
          <td>{{ $photo->titre }}</td>
          <td class="text-left">{!! $photo->description !!}</td>
          <td>
            @if (!is_null($photo->video))
              <p class="hidden">1</p><!-- pour trier les photos -->
              <a href="{{ $photo->video }}" target="_blank"><i class="fa fa-film text-primary"></i></a>
            @else
              <p class="hidden">0</p><!-- pour trier les photos -->
              <i class="fa fa-times text-danger"></i>
            @endif
          </td>
          <td>
            @if($photo->active == 1)
              <p class="hidden">1</p><!-- pour trier les photos -->
              <i class="fa fa-check text-success"></i>
            @else
              <p class="hidden">0</p><!-- pour trier les photos -->
              <i class="fa fa-times text-danger"></i>
            @endif
          </td>
          <td>{{ Carbon\Carbon::parse($photo->updated_at)->format("d/m/y H:m") }}</td>
          <td>
            <a href="{{ route('photos.update', ['id' => $photo['id']]) }}" class="btn btn-xs btn-warning">
              <i class="fa fa-pencil"></i> Editer
            </a>
            <a href="{{ route('photos.remove', ['id' => $photo['id']]) }}" class="btn btn-xs btn-danger delete" >
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
            "sSwfPath": "localhost:8000/swf/copy_csv_xls_pdf.swf"
          }
        });
      $('.delete').on("click", function(){
        return confirm("Attention, supprimer une photo est irréversible. Veux-tu réellement supprimer cette photo ?");
      });
    })
  </script>
@endsection
