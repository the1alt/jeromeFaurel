@extends('layout')


@section('content')
  <div class="presentation">

    <img id="photo-id" src="uploads/photos/jerome-faurel.jpg" alt="Jérôme FAUREL" class="img-responsive">

    <p>
      Batteur de formation, ma passion pour le son est venue de la musique. C'est en BTS audiosuel option son que j'ai découvert le travail du son à l'image qui m'a tout de suite séduit.
    </p>
    <p>
      J'ai débuté ma vie professionnelle dans la sonorisation de spectacles vivants et de concerts, puis dans la prise de son de fiction.
    </p>
    <p>
      Je suis entré dans le domaine de la post-production grâce aux membres de "La Belle Equipe", des musiciens pour lesquels je travaille encore en tant qu'ingénieur son.
    </p>
    <p>
      Ils m'ont permis de rencontrer Thierry Lebon, mixeur cinéma et ex-gérant des studios Merjithur ainsi que les ingénieurs du son Eric Chevallier et Samy Bardet.
    </p>
    <p>
      En intégrant ces deux équipes j'ai travaillé sur de nombreux projets allant de la publicité au long-métrage  et enrichi mes compétences dans le domaine de la post-production son.
    </p>
    <p>
      Ces différentes collaborations n'ont fait qu'amplifier mon goût pour la création sonore.
    </p>
    <p>
    Toujours en tant qu'indépendant, je continue mon parcours en veillant à garder une ligne professionelle et artistique.
    </p>

    <div class="cv">
      <p>
        Pour télécharger mon CV :
      </p>
      <a href="{{ asset('uploads/cv-jeromefaurel.pdf') }}" target="_blank" data-type="document" id="cv-link" titre="CV Jérôme FAUREL">
        <div class="cv-pdf">
          <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
          <span>CV Jerôme Faurel 2015.pdf</span>
        </div>
      </a>
    </div>
  </div>


@endsection
