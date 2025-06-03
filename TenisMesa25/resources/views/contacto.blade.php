@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row">

        <div class="col-12 text-center mb-4">
            <h1 class="display-4 text-primary">¿Dónde estamos?</h1>
        </div>

        <div class="col-md-6">
            <h3 class="h4 text-secondary">Información de Contacto</h3>
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

        <div class="col-md-6">
            <h3 class="h4 text-secondary">Horario de Entrenamientos</h3>
            <ul class="list-unstyled">
                <li><strong>Lunes:</strong> 19:00 - 21:30</li>
                <li><strong>Martes:</strong> Cerrado</li>
                <li><strong>Miércoles:</strong> 19:00 - 21:30</li>
                <li><strong>Jueves:</strong> Cerrado</li>
                <li><strong>Viernes:</strong> 19:00 - 21:30</li>
                <li><strong>Sábado:</strong> Cerrado</li>
                <li><strong>Domingo:</strong> Cerrado</li>
            </ul>
        </div>

        <div class="col-12 mt-4">
            <h3 class="h4 text-secondary">¿Cómo llegar?</h3>
            <p>Consulta el mapa interactivo de Google Maps para ver nuestra ubicación exacta:</p>
            <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3041.8459078652054!2d-3.5143719881377877!3d40.32357727133564!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd423c10f245f32b%3A0x47eacd3bb2ed548e!2sPolideportivo%20Municipal%20Parque%20del%20Sureste!5e0!3m2!1ses!2ses!4v1743762818864!5m2!1ses!2ses" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
    </div>
</div>
@endsection
