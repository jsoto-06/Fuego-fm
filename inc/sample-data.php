<?php
/**
 * Fuego FM - Default Fallback Data & Sample Feeds
 * Guarantees the theme displays rich, fully formatted data out of the box.
 */

if (!defined('ABSPATH')) {
    exit;
}

function fuego_get_default_dials() {
    $img_base = get_template_directory_uri() . '/assets/images/';

    return array(
        array(
            'id'        => 'event_1',
            'tag'       => 'BACHATA · MADRID',
            'title'     => 'Madrid Bachata Sensation 2026',
            'genre'     => '📅 28 de octubre de 2026 · 📍 Madrid',
            'category'  => 'Bachata',
            'artists'   => '¡Madrid se llena de sentimiento, sensualidad y mucho ritmo! DJs especializados, talleres de baile y social.',
            'content'   => "¡Madrid se llena de sentimiento, sensualidad y mucho ritmo! 💃🕺\nEl próximo 28 de octubre, prepárate para vivir una noche inolvidable dedicada al 100 % a la bachata.\n\n¿Qué te espera?\n✨ DJs especializados en bachata moderna, sensual y tradicional.\n✨ Talleres de baile para principiantes y bailarines avanzados.\n✨ Sesiones sociales para conocer gente y disfrutar de la pista.\n✨ Un ambiente increíble con amantes del baile llegados de diferentes ciudades.\n\n📅 Fecha: 28 de octubre de 2026\n📍 Lugar: Sala Ritmo Latino — Madrid\n⏰ Horario: 20:00 h – 03:00 h\n\nNo importa si vienes solo o en pareja: lo importante es tener ganas de bailar, compartir y disfrutar.\n🎟️ Entradas anticipadas disponibles próximamente. ¡Prepara tus mejores pasos y vive una noche llena de pasión!\nEvento ficticio de ejemplo para KLK Radio 47.",
            'dj'        => 'Sala Ritmo Latino — Madrid',
            'listeners' => '20:00 h – 03:00 h',
            'date'      => '28 de octubre de 2026',
            'time'      => '20:00 h – 03:00 h',
            'venue'     => 'Sala Ritmo Latino — Madrid',
            'image'     => $img_base . 'dial-bachata.jpg',
            'stream'    => 'https://srv1.streamingradio.ar/8380/stream',
            'btn_text'  => '🎟️ Ver Evento',
            'badge_bg'  => 'bg-tertiary-container',
            'badge_txt' => 'text-white'
        ),
        array(
            'id'        => 'event_2',
            'tag'       => 'SALSA · BILBAO',
            'title'     => 'Bilbao Salsa & Sabor Festival',
            'genre'     => '📅 7 de noviembre de 2026 · 📍 Bilbao',
            'category'  => 'Salsa',
            'artists'   => '¡Bilbao va a bailar al ritmo de la salsa! Clásicos, salsa cubana, orquesta en vivo y gran pista de baile.',
            'content'   => "¡Bilbao va a bailar al ritmo de la salsa! 🇨🇺🔥\nLlega Bilbao Salsa & Sabor Festival, una fiesta pensada para quienes llevan el ritmo en la sangre y quieren disfrutar de una noche cargada de energía, música y sabor caribeño.\n\nPrepárate para una experiencia latina con:\n🎶 Los mejores clásicos de la salsa y los éxitos actuales.\n💃 Clases de salsa cubana y salsa en línea para todos los niveles.\n🥁 Música en directo con una banda latina invitada.\n🕺 Una gran pista de baile para compartir con amigos y conocer gente nueva.\n\n📅 Fecha: 7 de noviembre de 2026\n📍 Lugar: Sala Sabor del Norte — Bilbao\n⏰ Horario: 18:00 h – 02:00 h\n\nTanto si eres un bailarín experimentado como si estás dando tus primeros pasos, encontrarás tu sitio en esta fiesta.\n🎟️ ¡Ven a disfrutar del auténtico sabor latino en Bilbao!\nEvento ficticio de ejemplo para KLK Radio 47.",
            'dj'        => 'Sala Sabor del Norte — Bilbao',
            'listeners' => '18:00 h – 02:00 h',
            'date'      => '7 de noviembre de 2026',
            'time'      => '18:00 h – 02:00 h',
            'venue'     => 'Sala Sabor del Norte — Bilbao',
            'image'     => $img_base . 'dial-salsa.jpg',
            'stream'    => 'https://srv1.streamingradio.ar/8380/stream',
            'btn_text'  => '🎟️ Ver Evento',
            'badge_bg'  => 'bg-secondary-container',
            'badge_txt' => 'text-on-secondary-container'
        ),
        array(
            'id'        => 'event_3',
            'tag'       => 'REGUETÓN · BARAKALDO',
            'title'     => 'Noche Urbana Latina: Reguetón & Perreo',
            'genre'     => '📅 14 de noviembre de 2026 · 📍 Barakaldo',
            'category'  => 'Reguetón',
            'artists'   => '🚨 ¡Atención, amantes del género urbano! Sesión sin pausas con reguetón old & new school, dembow y buena vibra.',
            'content'   => "🚨 ¡Atención, amantes del género urbano! 🚨\nLa noche se enciende con Noche Urbana Latina, una fiesta donde el reguetón, el dembow y los sonidos urbanos serán los protagonistas.\n\nPrepárate para una sesión sin pausas con los temas que dominan las pistas de baile y los grandes clásicos que nunca pasan de moda.\n\n¿Qué encontrarás?\n🔥 DJs invitados con sesiones de reguetón old school y new school.\n🎧 Los éxitos de la música urbana latina.\n💥 Efectos de luces y una atmósfera de auténtica fiesta.\n📸 Zona de fotos para llevarte el recuerdo de una noche especial.\n\n📅 Fecha: 14 de noviembre de 2026\n📍 Lugar: Urban Beat Club — Barakaldo\n⏰ Horario: De 23:00 a 05:00 h.\n\nReúne a tu grupo, prepara tu mejor outfit y ven a disfrutar de una noche que promete mucho perreo y buena vibra.\n🎟️ Entradas de ejemplo: anticipada, general y VIP.\nEvento ficticio de ejemplo para KLK Radio 47.",
            'dj'        => 'Urban Beat Club — Barakaldo',
            'listeners' => '23:00 h – 05:00 h',
            'date'      => '14 de noviembre de 2026',
            'time'      => '23:00 h – 05:00 h',
            'venue'     => 'Urban Beat Club — Barakaldo',
            'image'     => $img_base . 'dial-urbano.jpg',
            'stream'    => 'https://srv1.streamingradio.ar/8380/stream',
            'btn_text'  => '🎟️ Ver Evento',
            'badge_bg'  => 'bg-primary-container',
            'badge_txt' => 'text-white'
        ),
        array(
            'id'        => 'event_4',
            'tag'       => 'FESTIVAL · PORTUGALETE',
            'title'     => 'Festival Latino: Colombia y República Dominicana',
            'genre'     => '📅 21 de noviembre de 2026 · 📍 Portugalete',
            'category'  => 'Festival Latino',
            'artists'   => '🌎 ¡Dos culturas, un solo corazón! Merengue, bachata, salsa, vallenato, gastronomía latina y ambiente familiar.',
            'content'   => "🌎 ¡Dos culturas, un solo corazón y una fiesta llena de sabor!\nLlega Festival Latino Sin Fronteras, un encuentro dedicado a celebrar la música, la gastronomía y la alegría de Latinoamérica, con especial protagonismo de Colombia y República Dominicana.\n\nUna jornada para compartir nuestras raíces y disfrutar de una experiencia multicultural:\n🎶 Merengue, bachata, salsa, vallenato y música urbana.\n🇨🇴 Sonidos colombianos para cantar y bailar sin parar.\n🇩🇴 El ritmo dominicano que convierte cualquier lugar en una fiesta.\n🍴 Zona gastronómica con sabores latinos.\n💃 Animación, baile y actividades para disfrutar en familia.\n\n📅 Fecha: 21 de noviembre de 2026\n📍 Lugar: Plaza del Encuentro Latino — Portugalete\n⏰ Horario: Desde las 16:00 h.\n\nVen con tus amigos, tu pareja o toda la familia. Celebremos juntos la diversidad, la cultura y la pasión que nos une a través de la música.\n🎟️ Entrada y programación: información próximamente.\nEvento ficticio de ejemplo para KLK Radio 47.",
            'dj'        => 'Plaza del Encuentro — Portugalete',
            'listeners' => '16:00 h – 00:00 h',
            'date'      => '21 de noviembre de 2026',
            'time'      => '16:00 h – 00:00 h',
            'venue'     => 'Plaza del Encuentro Latino — Portugalete',
            'image'     => $img_base . 'dial-cumbia.jpg',
            'stream'    => 'https://srv1.streamingradio.ar/8380/stream',
            'btn_text'  => '🎟️ Ver Evento',
            'badge_bg'  => 'bg-secondary-container',
            'badge_txt' => 'text-on-secondary-container'
        ),
        array(
            'id'        => 'event_5',
            'tag'       => 'REMEMBER · SANTANDER',
            'title'     => 'Remember 2000: Los Clásicos de la Música Latina',
            'genre'     => '📅 5 de diciembre de 2026 · 📍 Santander',
            'category'  => 'Fiesta Remember',
            'artists'   => '🎶 ¡Hay canciones que nunca se olvidan! Reguetón clásico 2000s, bachata romántica, salsa y merengue inolvidable.',
            'content'   => "🎶 ¡Hay canciones que nunca se olvidan!\nVuelve a los años dorados de la música latina con Remember 2000: Latin Edition, una noche para recordar aquellos temas que marcaron una época y que todavía hoy nos hacen cantar a pleno pulmón.\n\nPrepárate para viajar en el tiempo con una selección musical llena de nostalgia, ritmo y buenos recuerdos:\n🎧 Reguetón clásico de los años 2000.\n💃 Bachata romántica para bailar en pareja.\n🔥 Éxitos de merengue, salsa y música latina.\n🎤 Un recorrido por las canciones que marcaron a toda una generación.\n🥳 Un ambiente de fiesta para reencontrarse con los mejores recuerdos musicales.\n\n📅 Fecha: 5 de diciembre de 2026\n📍 Lugar: Retro Latino Club — Santander\n⏰ Horario: De 22:00 a 04:00 h.\n\nSi alguna vez bailaste estos temas, esta noche es para ti. Y si los descubriste después, prepárate para conocer los clásicos que hicieron historia.\n🎟️ ¡Reserva la fecha y vuelve a vivir la música de aquellos años!\nEvento ficticio de ejemplo para KLK Radio 47.",
            'dj'        => 'Retro Latino Club — Santander',
            'listeners' => '22:00 h – 04:00 h',
            'date'      => '5 de diciembre de 2026',
            'time'      => '22:00 h – 04:00 h',
            'venue'     => 'Retro Latino Club — Santander',
            'image'     => $img_base . 'dial-classics.jpg',
            'stream'    => 'https://srv1.streamingradio.ar/8380/stream',
            'btn_text'  => '🎟️ Ver Evento',
            'badge_bg'  => 'bg-tertiary-container',
            'badge_txt' => 'text-white'
        ),
    );
}

function fuego_get_default_ranking() {
    $img_base = get_template_directory_uri() . '/assets/images/';

    return array(
        array(
            'id'         => 'rank-1',
            'rank'       => '01',
            'title'      => 'LUNA',
            'artist'     => 'Feid ft. ATL Jacob',
            'trend'      => '↑ 2',
            'trend_class'=> 'text-secondary-container bg-secondary-container/20',
            'votes'      => (int) get_option('fuego_votes_rank_1', 84120),
            'image'      => $img_base . 'rank-1.jpg',
            'is_grand'   => true
        ),
        array(
            'id'         => 'rank-2',
            'rank'       => '02',
            'title'      => 'Qlona',
            'artist'     => 'Karol G & Peso Pluma',
            'trend'      => '= 0',
            'trend_class'=> 'text-primary bg-primary/20',
            'votes'      => (int) get_option('fuego_votes_rank_2', 72450),
            'image'      => $img_base . 'rank-2.jpg',
            'is_grand'   => false
        ),
        array(
            'id'         => 'rank-3',
            'rank'       => '03',
            'title'      => 'Diluvio',
            'artist'     => 'Rauw Alejandro',
            'trend'      => '↑ 4',
            'trend_class'=> 'text-secondary-container bg-secondary-container/20',
            'votes'      => (int) get_option('fuego_votes_rank_3', 68900),
            'image'      => $img_base . 'rank-3.jpg',
            'is_grand'   => false
        ),
        array(
            'id'         => 'rank-4',
            'rank'       => '04',
            'title'      => 'Perro Negro',
            'artist'     => 'Bad Bunny & Feid',
            'trend'      => 'NEW',
            'trend_class'=> 'text-tertiary bg-tertiary/20',
            'votes'      => (int) get_option('fuego_votes_rank_4', 65200),
            'image'      => $img_base . 'rank-4.jpg',
            'is_grand'   => false
        ),
        array(
            'id'         => 'rank-5',
            'rank'       => '05',
            'title'      => 'OA',
            'artist'     => 'Anuel AA, Maluma, Quevedo',
            'trend'      => '↓ 1',
            'trend_class'=> 'text-on-surface-variant bg-surface-container-highest',
            'votes'      => (int) get_option('fuego_votes_rank_5', 59300),
            'image'      => $img_base . 'rank-5.jpg',
            'is_grand'   => false
        ),
    );
}

function fuego_get_default_shows() {
    return array(
        array(
            'time'      => '06:00 - 10:00',
            'title'     => 'El Despertar Latino',
            'host'      => "Con Carlos 'El Chévere'",
            'status'    => 'past',
            'status_tag'=> 'check_circle',
        ),
        array(
            'time'      => '10:00 - 14:00',
            'title'     => 'La Batidora Urbana',
            'host'      => 'DJ Mateo & Sofía Santos',
            'status'    => 'live',
            'status_tag'=> 'EN EL AIRE',
        ),
        array(
            'time'      => '14:00 - 18:00',
            'title'     => 'Tarde de Salsa & Sabor',
            'host'      => 'Con Maestro Tito Valdez',
            'status'    => 'upcoming',
            'status_tag'=> 'schedule',
        ),
        array(
            'time'      => '18:00 - 02:00',
            'title'     => 'Noche Candente & Club Sets',
            'host'      => 'DJ Nelson Flow & Invitados',
            'status'    => 'upcoming',
            'status_tag'=> 'schedule',
        ),
    );
}

function fuego_get_default_shoutouts() {
    return array(
        array(
            'author'   => 'Valeria M.',
            'location' => 'Medellín, COL 🇨🇴',
            'loc_color'=> 'text-secondary-container',
            'message'  => '¡Saludos a toda la comuna 13! La Batidora no se apaga nunca en el taller. Pongan Rauw porfa 🔥',
            'time_ago' => 'Hace 1 min',
            'likes'    => 42
        ),
        array(
            'author'   => 'Marcos & Andy',
            'location' => 'Miami, USA 🇺🇸',
            'loc_color'=> 'text-primary',
            'message'  => 'Conectados desde la I-95 en Brickell. El bitrate en 320k suena brutal en el auto. ¡Un abrazo Mateo!',
            'time_ago' => 'Hace 3 min',
            'likes'    => 28
        ),
        array(
            'author'   => 'Laura G.',
            'location' => 'Madrid, ESP 🇪🇸',
            'loc_color'=> 'text-tertiary',
            'message'  => 'Son las 5 de la tarde acá y nos tienen prendiendo el piso entero de la oficina. ¡Son los mejores!',
            'time_ago' => 'Hace 5 min',
            'likes'    => 56
        ),
        array(
            'author'   => "Diego 'Chino'",
            'location' => 'CDMX, MEX 🇲🇽',
            'loc_color'=> 'text-secondary',
            'message'  => 'Poniendo Fuego FM en el gimnasio de Condesa, la gente se motivó al mil con el set de dembow.',
            'time_ago' => 'Hace 7 min',
            'likes'    => 39
        ),
    );
}

/**
 * Default Rich Content for Essential Static Pages
 */
function fuego_get_default_static_pages() {
    return array(
        'acerca-de-nosotros' => array(
            'title'   => __('Acerca de nosotros', 'fuego-fm'),
            'content' => "<p><strong>KLK Radio 47 - Sabor Latino</strong> es la estación de radio oficial diseñada para conectar el corazón de la comunidad hispana en todo el mundo con los ritmos más encendidos: Salsa brava, Bachata de medianoche, Reggaetón, Dembow, Cumbia y los grandes clásicos que marcaron época.</p>\n\n<h3>🔥 Nuestra Misión</h3>\n<p>Llevar la auténtica vibra latina las 24 horas del día sin interrupciones, combinando el sonido más nítido con transmisiones interactivas donde la audiencia es protagonista a través del Muro de Oyentes en vivo, notas de voz a cabina y votaciones populares en directo.</p>\n\n<h3>📡 Sonido de Alta Fidelidad 24/7</h3>\n<p>Transmitimos en tiempo real utilizando servidores ShoutCast v2 dedicados con procesamiento dinámico y codificación hasta 320 kbps HD. Nuestra señal global garantiza una estabilidad superior al 99.98% de disponibilidad, optimizada tanto para conexión web y móvil como para sistemas de audio de automóviles compatibles con Apple CarPlay y Android Auto.</p>\n\n<h3>🎙️ En Cabina Principal</h3>\n<p>Nuestra programación cuenta con la conducción estelar de <strong>Miguel 47</strong> al mando de <em>\"Los reyes de la Salsa\"</em>, junto a un elenco de DJs residentes especializados en cada género musical, sesiones en vivo y mezclas exclusivas preparadas para encender cada rincón.</p>\n\n<h3>🎧 Comunidad Global</h3>\n<p>Desde Madrid, Bilbao y Barcelona hasta Medellín, Santo Domingo, San Juan, Miami y Ciudad de México, KLK Radio 47 une a miles de oyentes diarios bajo una misma bandera musical. Conéctate con nosotros en todas nuestras redes sociales oficiales <strong>@klkradio47</strong>.</p>",
        ),
        'contactenos' => array(
            'title'   => __('Contáctenos', 'fuego-fm'),
            'content' => "<p>¿Quieres saludar al aire, pedir una canción para tu persona especial, promocionar tu evento o pautar publicidad en <strong>KLK Radio 47</strong>? ¡Estamos a tu completa disposición!</p>\n\n<h3>📲 Línea Directa de Cabina (WhatsApp)</h3>\n<p>Envía tus notas de voz, saludos para que el DJ los lea al aire y pedidos musicales inmediatos directamente a nuestra cabina de transmisión.</p>\n<p><a href=\"https://wa.me/1234567890?text=%C2%A1Hola%20KLK%20Radio%2047!%20Me%20gustar%C3%ADa%20enviar%20un%20saludo%20a%20cabina%20%F0%9F%94%A5\" target=\"_blank\" rel=\"noopener noreferrer\"><strong>👉 Enviar Saludo por WhatsApp</strong></a></p>\n\n<h3>✉️ Correo Electrónico y Publicidad</h3>\n<p>Para contrataciones de DJs, notas de prensa, cobertura de festivales, entrevistas y campañas de patrocinio comercial:</p>\n<ul>\n  <li><strong>Contacto General y Oyentes:</strong> <a href=\"mailto:contacto@klkradio47.com\">contacto@klkradio47.com</a></li>\n  <li><strong>Publicidad y Eventos:</strong> <a href=\"mailto:publicidad@klkradio47.com\">publicidad@klkradio47.com</a></li>\n</ul>\n\n<h3>⏰ Horarios de Transmisión</h3>\n<ul>\n  <li><strong>Emisión de Radio:</strong> 24 Horas al día, 7 días a la semana sin interrupciones.</li>\n  <li><strong>Atención Administrativa:</strong> Lunes a Viernes de 09:00 a 19:00 h.</li>\n</ul>\n\n<h3>📍 Redes Sociales Oficiales</h3>\n<p>Síguenos e interactúa con nosotros:</p>\n<ul>\n  <li><strong>Instagram:</strong> <a href=\"https://instagram.com/klkradio47\" target=\"_blank\" rel=\"noopener noreferrer\">@klkradio47</a></li>\n  <li><strong>TikTok:</strong> @klkradio47</li>\n  <li><strong>Facebook:</strong> KLK Radio 47 Oficial</li>\n</ul>",
        ),
        'politica-de-privacidad' => array(
            'title'   => __('Política de privacidad', 'fuego-fm'),
            'content' => "<p>En <strong>KLK Radio 47</strong> (en adelante, \"la Emisora\" o \"el Sitio Web\"), respetamos y protegemos la privacidad de todos nuestros oyentes y usuarios. La presente Política de Privacidad describe cómo se recopila, utiliza y protege la información al interactuar con nuestra plataforma digital de streaming.</p>\n\n<h3>1. Responsable del Tratamiento de los Datos</h3>\n<p>El responsable del tratamiento de los datos recogidos en este sitio web es <strong>KLK Radio 47 - Sabor Latino</strong>. Para cualquier consulta o ejercicio de derechos de privacidad, puedes contactarnos en: <a href=\"mailto:contacto@klkradio47.com\">contacto@klkradio47.com</a>.</p>\n\n<h3>2. Datos que Recopilamos</h3>\n<ul>\n  <li><strong>Datos Técnicos de Transmisión:</strong> Dirección IP anonimizada, tipo de navegador y parámetros de conexión estrictamente necesarios para la entrega del flujo de audio streaming ShoutCast.</li>\n  <li><strong>Mensajes y Saludos del Muro de Oyentes:</strong> Nombre o alias y mensaje enviado voluntariamente para ser publicado en la plataforma comunitaria y/o leído en cabina.</li>\n  <li><strong>Peticiones Musicales:</strong> Título del tema, artista y dedicatoria enviada mediante el formulario interactivo de cabina.</li>\n  <li><strong>Comunicaciones por WhatsApp:</strong> Número de teléfono y contenido de los mensajes remitidos libremente por el usuario al pulsar los botones de contacto.</li>\n</ul>\n\n<h3>3. Finalidad del Tratamiento</h3>\n<p>Los datos facilitados se utilizan exclusivamente para:</p>\n<ol>\n  <li>Garantizar la correcta recepción y reproducción técnica de la señal de radio en vivo.</li>\n  <li>Emitir al aire y publicar en la web los saludos, dedicatorias y peticiones solicitadas por la audiencia.</li>\n  <li>Contabilizar de manera transparente los votos anónimos en nuestro ranking semanal <em>El Termómetro Latino</em>.</li>\n  <li>Atender solicitudes de información comercial o consultas sobre eventos.</li>\n</ol>\n\n<h3>4. Cookies y Almacenamiento Local</h3>\n<p>Utilizamos almacenamiento local técnico en tu navegador (LocalStorage) exclusivamente para recordar tus preferencias de usuario, como el nivel de volumen, estado de reproducción y prevención de votos duplicados en el ranking. No empleamos cookies invasivas de rastreo publicitario de terceros.</p>\n\n<h3>5. Enlaces a Terceros</h3>\n<p>Nuestro sitio web puede contener enlaces a plataformas de terceros (como WhatsApp, servicios de venta de entradas para eventos o perfiles de redes sociales). KLK Radio 47 no se responsabiliza de las prácticas de privacidad de dichos servicios externos.</p>\n\n<h3>6. Tus Derechos</h3>\n<p>En cualquier momento puedes solicitar el acceso, rectificación o eliminación de tus mensajes publicados en el Muro de Oyentes enviando un correo a <a href=\"mailto:contacto@klkradio47.com\">contacto@klkradio47.com</a> indicando tu solicitud.</p>",
        ),
        'terminos-del-servicio' => array(
            'title'   => __('Términos del servicio', 'fuego-fm'),
            'content' => "<p>Bienvenido a <strong>KLK Radio 47</strong>. Al acceder a nuestro sitio web, reproducir nuestra señal de streaming en directo o participar en nuestros módulos interactivos, aceptas cumplir con los siguientes Términos y Condiciones de Uso.</p>\n\n<h3>1. Uso de la Plataforma y Señal en Vivo</h3>\n<p>KLK Radio 47 proporciona una señal de transmisión de audio gratuita y de libre acceso destinada al entretenimiento personal y colectivo. Queda prohibida la retransmisión comercial, alteración de la señal o uso no autorizado de nuestros flujos de streaming sin consentimiento previo por escrito.</p>\n\n<h3>2. Propiedad Intelectual y Derechos Musicales</h3>\n<p>Todos los logotipos, elementos gráficos, diseño de la interfaz web, grabaciones de identificación de cabina (jingles, sweeps e intervenciones de locutores) son propiedad de KLK Radio 47. Los temas musicales transmitidos pertenecen a sus respectivos autores, intérpretes y sellos discográficos, difundiéndose conforme a los marcos legales de comunicación pública y radiodifusión en línea.</p>\n\n<h3>3. Normas de Participación en el Muro de Oyentes y Cabina</h3>\n<p>Al enviar saludos, notas de voz o mensajes para el Muro de Oyentes o WhatsApp de cabina, el usuario se compromete a:</p>\n<ul>\n  <li>Mantener un lenguaje respetuoso, constructivo y libre de discriminación o violencia.</li>\n  <li>No publicar spam, enlaces comerciales no autorizados ni información confidencial de terceros.</li>\n  <li>Comprender que los mensajes son públicos y podrán ser leídos al aire durante la transmisión en directo.</li>\n</ul>\n<p>KLK Radio 47 se reserva el derecho de moderar, editar o retirar cualquier mensaje que incumpla estas normas sin previo aviso.</p>\n\n<h3>4. Votaciones en \"El Termómetro Latino\"</h3>\n<p>El ranking musical se basa en la votación popular de nuestros oyentes. Queda prohibido el empleo de bots, scripts automatizados o métodos fraudulentos destinados a alterar artificialmente los resultados de las votaciones.</p>\n\n<h3>5. Agenda de Eventos y Entradas de Terceros</h3>\n<p>La información referente a festivales, conciertos y discotecas publicada en la agenda de la emisora tiene carácter informativo. KLK Radio 47 no organiza ni expide directamente los accesos a recintos gestionados por salas o productoras externas, por lo que cualquier consulta sobre reembolsos, cambios de fecha o condiciones de admisión corresponde a los organizadores respectivos.</p>\n\n<h3>6. Modificaciones de los Términos</h3>\n<p>Nos reservamos el derecho de actualizar estos términos en cualquier momento para reflejar cambios legales o técnicos. La continuidad en el uso del sitio web tras la publicación de modificaciones implica su plena aceptación.</p>",
        ),
    );
}

/**
 * Automatically ensure the 4 static pages exist in WordPress and are published
 */
function fuego_ensure_static_pages() {
    $pages = fuego_get_default_static_pages();
    $created_any = false;

    foreach ($pages as $slug => $data) {
        $existing = get_page_by_path($slug, OBJECT, 'page');
        if (!$existing) {
            $existing = get_page_by_title($data['title'], OBJECT, 'page');
        }

        if (!$existing) {
            $page_id = wp_insert_post(array(
                'post_title'     => $data['title'],
                'post_name'      => $slug,
                'post_content'   => $data['content'],
                'post_status'    => 'publish',
                'post_type'      => 'page',
                'comment_status' => 'closed',
                'ping_status'    => 'closed',
            ));

            if ($page_id && !is_wp_error($page_id)) {
                $created_any = true;
                if ($slug === 'politica-de-privacidad' && !get_option('wp_page_for_privacy_policy')) {
                    update_option('wp_page_for_privacy_policy', $page_id);
                }
            }
        }
    }

    if ($created_any) {
        flush_rewrite_rules(false);
    }
}

/**
 * Ensure static pages are initialized on theme switch, init, or admin load
 */
function fuego_maybe_create_static_pages() {
    $needed_slugs = array('acerca-de-nosotros', 'contactenos', 'politica-de-privacidad', 'terminos-del-servicio');
    $missing = false;

    foreach ($needed_slugs as $slug) {
        if (!get_page_by_path($slug, OBJECT, 'page') && !get_page_by_title($slug, OBJECT, 'page')) {
            $missing = true;
            break;
        }
    }

    if ($missing || !get_option('fuego_static_pages_v2_created')) {
        fuego_ensure_static_pages();
        update_option('fuego_static_pages_v2_created', 1);
    }
}
add_action('after_switch_theme', 'fuego_ensure_static_pages');
add_action('init', 'fuego_maybe_create_static_pages');
add_action('admin_init', 'fuego_ensure_static_pages');

