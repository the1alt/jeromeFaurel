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

  <h1>Liste des catégories</h1>
  <table class="table table-bordered text-center">
    <thead>
      <tr>
        <th>Titre</th>
        <th>Nombre de projets</th>
        <th>Visible</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($categories as $key => $categorie)
        <tr>
          <td>{{ $categorie->name }}</td>
          <td class="text-center">{{ count($categorie->projets) }}</td>
          <td class="text-center">
            @if($categorie->active === 1)
              <p class="hidden">1</p><!-- pour trier les photos -->
              <i class="fa fa-check text-success"></i>
            @else
              <p class="hidden">0</p><!-- pour trier les photos -->
              <i class="fa fa-times text-danger"></i>
            @endif
          </td>
          <td class="text-center">
            <a href="{{ route('categories.update', ['id' => $categorie['id']]) }}" class="btn btn-xs btn-warning">
              <i class="fa fa-pencil"></i> Editer
            </a>
            <a href="{{ route('categories.remove', ['id' => $categorie['id']]) }}" class="btn btn-xs btn-danger delete" >
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
            "sSwfPath": "localhost:8000/swf/copy_csv_xls_pdf.swf"
          }
        });
      $('.delete').on("click", function(){
        return confirm("Attention, supprimer une catégorie est irréversible et supprimera tous les projets associés. Veux-tu réellement supprimer cette catégorie ?");
      });
    })
  </script>
@endsection
