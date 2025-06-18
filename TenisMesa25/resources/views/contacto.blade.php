@extends('layouts.app')

@section('content')

<div class="container py-5">
    <div class="row">
        <!-- Título -->
        <div class="col-12 text-center mb-5 fade-up">
            <h1 class="display-4 gradient-header">¿Dónde estamos?</h1>
        </div>

        <!-- Información de contacto -->
        <div class="col-md-6 fade-up fade-delay-1">
            <div class="card-style">
                <h3 class="h4 text-secondary mb-3">Información de Contacto</h3>
                <p><strong>Dirección:</strong> Polideportivo Parque del Sureste, Rivas-Vaciamadrid, 28522, Madrid</p>
                <p><strong>Teléfono:</strong> <a href="tel:+34654152194" class="text-decoration-none text-primary">+34 654 15 21 94</a></p>
                <p><strong>Correo electrónico:</strong> <a href="mailto:admon@rivastenisdemesa.com" class="text-decoration-none text-primary">admon@rivastenisdemesa.com</a></p>

                <h4 class="h5 mt-4">Redes Sociales:</h4>
                <ul class="list-unstyled">
                    <li><a href="https://www.youtube.com/channel/UC6-9EHYOnDjwHfPzl-HhDUA?app=desktop" target="_blank" class="text-decoration-none text-primary">YouTube</a></li>
                    <li><a href="https://www.instagram.com/rivastenisdemesa" target="_blank" class="text-decoration-none text-primary">Instagram</a></li>
                    <li><a href="https://www.facebook.com/rivastenisdemesa/?_rdr" target="_blank" class="text-decoration-none text-primary">Facebook</a></li>
                    <li><a href="https://x.com/cdtmrivas?lang=es" target="_blank" class="text-decoration-none text-primary">Twitter</a></li>
                </ul>
            </div>
        </div>

        <!-- Horarios -->
        <div class="col-md-6 fade-up fade-delay-2">
            <div class="card-style">
                <h3 class="h4 text-secondary mb-3">Horario de Entrenamientos</h3>
                <ul class="list-unstyled">
                    <li><strong>Lunes:</strong> 11:30H </li>
                    <li><strong>Martes:</strong> 12:30H</li>
                    <li><strong>Miércoles:</strong> 11:30H</li>
                    <li><strong>Jueves:</strong> 12:30H</li>
                    <li><strong>Viernes:</strong> Cerrado</li>
                    <li><strong>Sábado:</strong> Cerrado</li>
                    <li><strong>Domingo:</strong> Cerrado</li>
                </ul>
            </div>
        </div>

        <!-- Mapa -->
        <div class="col-12 mt-5 fade-up fade-delay-3">
            <h3 class="h4 text-secondary mb-3">¿Cómo llegar?</h3>
            <p>Consulta el mapa interactivo de Google Maps para ver nuestra ubicación exacta:</p>
            <div class="ratio ratio-16x9">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3041.8459078652054!2d-3.5143719881377877!3d40.32357727133564!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd423c10f245f32b%3A0x47eacd3bb2ed548e!2sPolideportivo%20Municipal%20Parque%20del%20Sureste!5e0!3m2!1ses!2ses!4v1743762818864!5m2!1ses!2ses" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
    </div>
</div>
@endsection