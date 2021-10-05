@extends('layouts.master')

@section('title', 'Soumission')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/form-control.css') }}">
<!-- Notyf CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
<!-- Fav Icon -->
<link rel="icon" href="{{ asset('assets/images/logo.png') }}">
<!-- Progress Bar -->
<link rel='stylesheet' href='https://unpkg.com/nprogress@0.2.0/nprogress.css' />
@endpush

@section('content')
<div class="crt-main submit__section">
    <div class="crt-404">
        <h1>Soumissions de logos pour la Côte d'Ivoire</h1>
        <p>
            Utilisez le formulaire ci-dessous pour soumettre un ou plusieurs logos aux archives de Nigeria Logos.
            La révision et la fusion de votre logo peuvent prendre jusqu'à 48 heures.
            Si vous êtes un développeur ou si vous avez un développeur disponible pour vous aider, vous pouvez contribuer directement au repo sur Github ici :
        </p>
        <br>
        <form id="add-submission" method="POST" enctype="multipart/form-data" method="{{ route('submission.store') }}">
            @csrf
            <div class="row">
                <div class="col-50 name">
                    <label for="name" class="float-left"><b>Votre nom </b><span class="text-danger">*</span></label>
                    <input type="text" name="name" placeholder="Votre nom.." id="name">
                </div>
                <div class="col-50 email">
                    <label for="email" class="float-left">
                        <b>Votre email</b>
                        <span class="text-danger">*</span>
                    </label>
                    <input type="text" name="email" placeholder="abc@email.com" id="email">
                    <small class="float-left description_input" style="display: none">
                        Nous en avons besoin pour pouvoir assurer un suivi avec vous au cas où des améliorations seraient recommandées
                        et aussi pour que nous puissions vous faire savoir quand vos logos sont en ligne sur le site.
                    </small>
                </div>
            </div>
            <div class="row">
                <div class="col-50 business_name">
                    <label for="business_name" class="float-left">
                        <b>Dénomination sociale de l'entreprise</b>
                        <span class="text-danger">*</span>
                    </label>
                    <input type="text" name="business_name" id="business_name" aria-describedby="business_name" placeholder="Ex: CreativeTeam (Communauté)">
                </div>
                <div class="col-50 url">
                    <label for="url" class="float-left">
                        <b>Site web de l'entreprise</b>
                        <span class="text-danger">*</span>
                    </label>
                    <input type="text" name="url" id="url" aria-describedby="url" placeholder="Ex: https://creative-team.ci">
                </div>
            </div>
            <div class="row">
                <div class="col-100 activity_areas_id">
                    <label for="activity_areas_id" class="float-left">
                        <b>Secteur d'activité</b>
                        <span class="text-danger">*</span>
                    </label>
                    <select name="activity_areas_id" id="activity_areas_id" aria-describedby="activity_areas_id">
                        <option value="0">Choisir le secteur</option>
                        @foreach ($activity_areas as $activity_area)
                            <option value="{{$activity_area->id}}">{{$activity_area->libelle}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-100 logo_png">
                    <label for="png_logo" class="float-left">
                        <b>Logo PNG</b>
                        <span class="text-danger">*</span>
                    </label>
                    <input name="logo_png" id="logo_png" type="file"  accept=".png">
                </div>
            </div>
            <div class="row">
                <div class="col-100 logo_svg">
                    <label for="svg_logo" class="float-left">
                        <b>Logo SVG</b>
                    </label>
                    <br><br>
                    <input name="logo_svg" id="logo_svg" type="file" accept=".svg">
                    <small class="float-left description_input mt-1">
                        Veuillez vous assurer que vos fichiers SVG sont propres et qu'ils n'ont pas de
                        formats d'image (par exemple png, jpgs) intégrés
                    </small><br/><br/>
                </div>
            </div>
            <div class="row">
                <div class="col-100">
                    <input type="button" class="soumettre" value="Soumettre" onclick="uploadFileFromAjax('add-submission')">
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
    <!-- Progress Bar -->
    <script src='https://unpkg.com/nprogress@0.2.0/nprogress.js'></script>

    <script>
        const uploadFileFromAjax = (formId) =>{
            $.ajax({
                type: 'POST',
                url: $("#"+formId).attr('action'),
                data: new FormData(document.getElementById(formId)),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData:false,
                beforeSend: function(){
                    NProgress.start();
                },
                success: function(data){
                    NProgress.done();
                    NProgress.remove();
                    //Lancer le téléchargement dans le cas d'un fichier
                    if(data.isFile){
                        exportAsExcelFile(data.data,data.filename)
                    }
                    //Clean Form
                    $("#"+formId).trigger("reset");
                    //Deleting errors
                    $('div').removeClass('has-error');
                    $('small.text-danger').remove();
                    //Diplay success message
                    // Create an instance of Notyf
                    var notyf = new Notyf({position: {x: 'right',y: 'top'},duration:7000,dismissible:true});
                    // Display a success notification
                    notyf.success(data.message);
                },
                error: function(xhr){
                    NProgress.done();
                    // NProgress.remove();
                        //console.log(response);
                    //Deleting errors
                    $('div').removeClass('has-error');
                    $('small.text-danger').remove();
                    //Displaying errors
                    $.each(xhr.responseJSON.message, function(key,value) {
                        //Affichage des erreurs
                        $('div.'+key).addClass('has-error');
                        $('div.'+key).append('<small class="control-label text-danger" for="inputError"><i class="fa fa-times-circle-o"></i>  '+value+'</small>');
                        // console.log(key+''+value)
                        // console.log(typeof(xhr.responseJSON.message)=='object')
                    })

                    // $('.loading').LoadingOverlay("hide");
                    // if(xhr.responseJSON.message!=undefined){
                    //     swal({
                    //         title: 'Echec...',
                    //         text: xhr.responseJSON.message,
                    //         type: "error",
                    //         showConfirmButton: true,
                    //     })
                    // }
                }
            });
        }
    </script>
@endpush
