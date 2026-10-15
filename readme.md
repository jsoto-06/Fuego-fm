# 📻 Manual Maestro de Configuración - KLK Radio 47 (Sabor Latino)
### Tema Premium para WordPress con Streaming en Vivo ShoutCast v2 / Icecast, Agenda de Eventos y Páginas Estáticas Oficiales

Bienvenido al manual maestro de tu estación de radio online **KLK Radio 47 - Sabor Latino**. En esta guía encontrarás todas las instrucciones paso a paso para administrar, personalizar y aprovechar al máximo cada una de las funciones de tu emisora en WordPress.

---

## 📋 1. Ficha Técnica del Tema

* **Nombre del Tema:** KLK Radio 47 - Sabor Latino
* **Versión Actual:** 1.0.11
* **Creado por:** `jsoto06` (enlazado a `https://klkradio47.com/`)
* **Text Domain:** `fuego-fm`
* **Tecnología Frontend:** HTML5 Audio API, Tailwind CSS, Google Fonts (Syne & Inter), Material Symbols
* **Compatibilidad:** WordPress 6.0 a 6.7+ | PHP 7.4, 8.0, 8.1, 8.2, 8.3+

---

## 📡 2. Credenciales y Servidor de Streaming ShoutCast v2

Tu servidor de streaming ya se encuentra completamente configurado e integrado por defecto en el tema:

* **Sistema de Radio:** ShoutCast v2.6
* **Servidor / Host:** `srv1.streamingradio.ar`
* **Puerto de Radio:** `8380`
* **Streaming en Vivo SSL (HTTPS):** `https://srv1.streamingradio.ar/8380/stream`
* **API de Estadísticas y Canción al Aire (JSON):** `https://srv1.streamingradio.ar:8380/stats?json=1`
* **Historial de Canciones Recientes:** `https://srv1.streamingradio.ar:8380/played?type=json`
* **Panel de Administración del Servidor de Radio:** `http://srv1.streamingradio.ar:8380/admin.cgi`
* **Usuario Administrador:** `admin`

---

## 🚀 3. Instalación y Actualización en WordPress

### Si instalas por primera vez:
1. Inicia sesión en tu panel de administración de WordPress (`tu-sitio.com/wp-admin`).
2. En el menú lateral izquierdo, ve a **Apariencia > Temas**.
3. Haz clic en el botón superior **Añadir nuevo tema** y luego en **Subir tema**.
4. Haz clic en **Seleccionar archivo** y elige `klk-radio-47.zip`.
5. Haz clic en **Instalar ahora** y, una vez finalizado, pulsa **Activar**.

### Si estás actualizando desde una versión anterior:
1. Ve a **Apariencia > Temas > Añadir nuevo tema > Subir tema**.
2. Selecciona el nuevo archivo `klk-radio-47.zip` y pulsa **Instalar ahora**.
3. WordPress te mostrará una pantalla comparativa; haz clic en el botón azul **"Reemplazar el activo por el subido"**.
4. ¡Listo! Tus contenidos, eventos, programas, saludos y canciones guardadas se conservarán intactos.

---

## 🎨 4. Identidad del Sitio, Logotipo y Menú Superior

### A. Subir tu Logotipo Oficial
1. Ve a **Apariencia > Personalizar > Identidad del sitio**.
2. Haz clic en **Seleccionar el logotipo** y sube tu archivo PNG con transparencia.
3. Si no subes un logo personalizado, el tema cargará automáticamente el logo oficial incluido de KLK Radio 47.

### B. Ajustar el Tamaño / Altura del Logotipo
1. Ve a **Apariencia > Personalizar > KLK Radio 47 - Configuración > 1. Tamaño del Logotipo y Cabecera**.
2. Utiliza el control deslizante **"Altura del Logotipo (en píxeles)"** (recomendado entre `40px` y `80px`).
3. Verás el cambio en vivo en la cabecera. Haz clic en **Publicar**.

### C. Navegación Web Superior (Menú Principal)
La barra superior incluye de forma nativa:
* **Logotipo de la emisora:** Con enlace a la portada y efecto interactivo.
* **Badge parpadeante "EN DIRECTO":** Indicador de señal en tiempo real.
* **Enlaces directos:**
  * *En Vivo* (`/#en-vivo`)
  * *Diales & Géneros* (`/#diales`)
  * *Programación* (`/#programacion`)
  * *Top 50 Latino* (`/#ranking`)
  * *Muro de Oyentes* (`/#comunidad`)
  * *App Móvil* (`/#app`)
  * *Acerca de* (Página estática `/acerca-de-nosotros/`)
  * *Contacto* (Página estática `/contactenos/`)
* **Buscador rápido:** Permite buscar temas y artistas en tu catálogo.
* **Botón "Escuchar Ahora":** Inicia la transmisión de radio con un solo clic.

---

## 📻 5. Reproductor Central (Hero) y Marca de Agua Desvanecida

La caja central del reproductor principal en portada cuenta con diseño glassmorphic oscuro y fondo personalizable:

### A. Fondo Desvanecido del Reproductor (Watermark o Imagen)
1. Ve a **Apariencia > Personalizar > KLK Radio 47 - Configuración > 2. Transmisión en Vivo (Streaming)**.
2. Localiza la sección **"Fondo del Reproductor Principal"**:
   * **Modo de Fondo:**
     * **Logotipo Oficial KLK Desvanecido (Recomendado):** Muestra el logotipo oficial en gran formato en la esquina inferior derecha con efecto marca de agua suave y resplandor neón ambiental.
     * **Subir Imagen Personalizada:** Te permite cargar cualquier foto de tu estudio, cabina o festival.
     * **Solo Gradiente y Luces Neón:** Deja un fondo limpio y minimalista con luces de ambiente.
   * **Nivel de Desvanecido / Opacidad (%):** Gradúa la transparencia (por defecto 15% para máxima legibilidad de los textos).
   * **Imagen de Fondo Personalizada:** Selector con vista previa para subir tu archivo si elegiste el modo personalizado.

### B. Calidad de Audio y Programa Central
En esta misma sección puedes modificar:
* **URL del Streaming Principal (SSL):** Por defecto `https://srv1.streamingradio.ar/8380/stream`.
* **URL de Estadísticas (JSON):** Por defecto `https://srv1.streamingradio.ar:8380/stats?json=1`.
* **Texto de Calidad / Bitrate:** Por defecto `128K HD` (puedes poner `320K HD` o lo que prefieras).
* **Contador o Estado de Oyentes:** Por defecto `EN DIRECTO`.

---

## 🎙️ 6. En Cabina Principal, Locutores y Redes Sociales Clicables

El bloque de cabina presenta a los locutores que están transmitiendo en el show principal:

1. Ve a **Apariencia > Personalizar > KLK Radio 47 - Configuración > 3. En Cabina Principal y Locutores**.
2. Configura los siguientes campos:
   * **Etiqueta Superior de Cabina:** Por defecto `EN CABINA PRINCIPAL`.
   * **Título del Programa en Vivo:** Por defecto `La Batidora Urbana`.
   * **Nombre del Locutor / DJ:** Por defecto `Miguel 47`.
   * **Lema o Estilo:** Por defecto `Los reyes de la Salsa`.
   * **Usuario Red Social 1:** Escribe tu usuario (ej. `@klkradio47`).
   * **Enlace URL Red Social 1 (Clicable):** Escribe el enlace completo (ej. `https://instagram.com/klkradio47` o `https://tiktok.com/@...`). Si lo dejas vacío, el tema enlazará automáticamente a Instagram con ese usuario.
   * **Usuario Red Social 2 y Enlace 2:** Para un segundo locutor o canal alternativo.
   * **Foto de los Locutores:** Sube una imagen cuadrada/circular. Si no subes ninguna, se mostrará la foto oficial de Miguel 47 incluida con el tema.
   * **Texto del Botón Nota de Voz:** Por defecto `Grabar nota de voz (15s)` (abre WhatsApp directamente para enviar audios al aire).

---

## 🎶 7. Recién Sonadas en Vivo (Historial Automático)

El tema se conecta de forma nativa a tu servidor ShoutCast v2 cada 12 segundos para obtener los últimos 3 temas reproducidos:

* **Sincronización automática:** Lee los metadatos desde `/played?type=json` y actualiza la lista en la web sin recargar la página.
* **Cálculo de tiempo relativo:** Muestra automáticamente cuánto tiempo hace que sonó cada tema (*Hace 1m*, *Hace 4m*, *Hace 8m*).
* **Edición manual de respaldo:** Si deseas definir títulos fijos de respaldo, puedes hacerlo en **Apariencia > Personalizar > KLK Radio 47 - Configuración > 4. Recién Sonadas y Métrica de Señal**.

---

## 🎟️ 8. Agenda de Eventos y Fiestas Latinas (Diales)

La sección de eventos de la portada promociona fiestas, conciertos y festivales con ventana emergente interactiva y botón directo de venta de entradas por WhatsApp:

### ¿Cómo crear o editar un evento?
1. En el menú izquierdo de WordPress, ve a **Eventos & Diales > Añadir Nuevo Evento** (o **Todos los Eventos**).
2. **Título del Evento:** Escribe el nombre de la fiesta (ej. *Madrid Bachata Sensation*, *Bilbao Salsa & Sabor Festival*, *Noche Urbana Latina: Reguetón & Perreo*, *Festival Latino*).
3. **Cuerpo del Evento:** Redacta la descripción, qué incluye la noche, talleres, DJs invitados y promociones. El tema lo mostrará perfectamente formateado y limpio en la ventana emergente.
4. **Caja "Configuración del Evento o Dial"** (debajo del editor):
   * **Etiqueta / Badge Superior:** Pastilla de color superior (ej. `BACHATA · MADRID`, `SALSA · BILBAO`, `REGUETÓN · BARAKALDO`).
   * **Fecha y Ciudad / Subtítulo:** (ej. `📅 28 de octubre de 2026 · 📍 Madrid`).
   * **Lugar / Sala del Evento:** (ej. `Sala Ritmo Latino — Madrid`).
   * **Horario del Evento:** (ej. `20:00 h – 03:00 h`).
   * **Imagen del Cartel / Evento:** Haz clic en **"Subir / Elegir Imagen"** para seleccionar el flyer desde tu biblioteca de medios. Verás la vista previa al instante.
   * **Texto del Botón:** Por defecto `🎟️ Ver Evento` (puedes cambiarlo a `Comprar Entradas`, `Reservar Mesa`, etc.).
   * **Enlace Web de Entradas o Streaming (Opcional):** Si tienes una ticketera externa o enlace web propio.
5. **Categorías de Eventos:** En la barra lateral derecha, asigna o crea una categoría (*Bachata*, *Salsa*, *Reguetón*, *Festival Latino*, *Fiesta Remember*) para que el filtro de botones de la portada funcione automáticamente.
6. Pulsa **Publicar** o **Actualizar**.

### Botón Directo a WhatsApp para Entradas:
Cuando un oyente hace clic en cualquier tarjeta de evento, se abre una ventana modal con los detalles completos y un botón verde destacado: **"Consultar Entradas en WhatsApp"**.
Al pulsarlo, se abre WhatsApp con un mensaje ya redactado:
`¡Hola KLK Radio 47! Quisiera más información y entradas para: [Nombre del Evento] 🎟️🔥`

### Modificar los Textos de Cabecera de la Sección:
1. Ve a **Apariencia > Personalizar > KLK Radio 47 - Configuración > 5. Agenda de Eventos y Diales**.
2. Modifica la **Etiqueta Superior**, el **Título Principal** y la **Descripción**.

---

## 🏆 9. Ranking Semanal: "El Termómetro Latino" (Top 5 en Directo)

El módulo de ranking permite que tus oyentes voten en directo por sus canciones favoritas:

### A. Editar los Textos de Cabecera ("VOTACIÓN EN DIRECTO")
1. Ve a **Apariencia > Personalizar > KLK Radio 47 - Configuración > 6. Ranking: El Termómetro Latino**.
2. Edita los 3 campos disponibles:
   * **Texto Superior (Badge):** Por defecto `VOTACIÓN EN DIRECTO` (puedes poner `TOP 5 LATINO`, `TÚ ELIGES EL #1`, `RANKING SEMANAL`).
   * **Título Principal:** Por defecto `EL TERMÓMETRO LATINO`.
   * **Subtítulo / Bajada:** Por defecto `Los 5 palos que dominan la calle esta semana según tu voto.`.
3. Haz clic en **Publicar**.

### B. Gestionar las Canciones, Artistas, Puestos y Votos
1. En el menú lateral izquierdo de WordPress, ve a **El Termómetro > Todos los Temas** (o **Añadir Canción al Ranking**).
2. Entra en cualquier canción o pulsa **Añadir Canción al Ranking**:
   * **Título:** Nombre del tema (ej. *LUNA*, *Qlona*, *Diluvio*).
   * **Artista(s):** (ej. *Feid ft. ATL Jacob*).
   * **Posición (1 al 5):** El puesto #1 recibe automáticamente el diseño ampliado con trofeo dorado.
   * **Tendencia:** Puedes indicar `↑ 2`, `= 0`, `NEW`, `↓ 1`.
   * **Votos Iniciales:** Cantidad de votos con la que arranca (ej. `84120`). Cada voto que haga la audiencia desde la web suma +1 en tiempo real por AJAX.
   * **Imagen Destacada:** Sube la portada oficial del álbum o sencillo.
3. Pulsa **Actualizar** o **Publicar**.

---

## 📅 10. Parrilla de Programación (Shows en Vivo)

Organiza los horarios de tus programas diarios:

1. Ve a **Programación > Añadir Programa** (o **Todos los Programas**).
2. **Título:** Nombre del show (ej. *El Despertar Latino*, *La Batidora Urbana*, *Tarde de Salsa & Sabor*, *Noche Candente & Club Sets*).
3. **Campos:**
   * **Franja Horaria:** (ej. `10:00 - 14:00 COT`).
   * **Locutor(es):** (ej. `DJ Mateo & Sofía Santos`).
   * **¿Al Aire Ahora?:** Marca esta casilla si el programa está transmitiendo en este momento. Al activarse, recibirá el borde brillante y el indicador animado "EN EL AIRE".
4. Pulsa **Publicar**.

---

## 💬 11. Muro de Oyentes en Vivo y Pedidos Musicales

### A. Muro de Oyentes:
* Los oyentes pueden escribir su nombre, saludo y ciudad directamente desde la portada y presionar **"Enviar Saludo"**.
* El mensaje se publica al instante en la web y queda archivado en WordPress bajo **Muro Oyentes**.
* Los visitantes pueden dar "Me gusta" (los likes se guardan mediante AJAX).
* Tú también puedes crear o moderar saludos desde **Muro Oyentes > Añadir Nuevo Saludo** asignando autor, ciudad y likes iniciales.

### B. Pedidos de Canción a Cabina:
* En el reproductor, el botón **"Pedir Canción"** abre una ventana emergente donde los oyentes escriben el tema, artista y dedicatoria.
* Las peticiones se guardan en el panel de WordPress para que los DJs las consulten y lean en vivo.

### C. Personalizar Textos y WhatsApp:
1. Ve a **Apariencia > Personalizar > KLK Radio 47 - Configuración > 7. Muro de Oyentes en Vivo**.
2. Configura los textos del muro y el **Número de WhatsApp Oficial** con prefijo internacional (ej. `+34600000000`).

---

## 📱 12. Banner para App Móvil y Conducción (CarPlay / Android Auto)

Promociona tu aplicación para smartphones y sistemas de sonido en vehículos:

1. Ve a **Apariencia > Personalizar > KLK Radio 47 - Configuración > 8. Enlaces App Móvil y CarPlay**.
2. Configura:
   * **Etiqueta Superior:** `APPLE CARPLAY & ANDROID AUTO READY`.
   * **Título del Banner:** `LLEVA EL FUEGO EN CADA KILÓMETRO`.
   * **Descripción:** Texto explicativo de las ventajas de la app.
   * **Enlace App Store (iOS):** Tu enlace a la tienda de Apple.
   * **Enlace Google Play (Android):** Tu enlace a la tienda de Google.

---

## 📄 13. Páginas Estáticas Oficiales y Pie de Página (Footer)

El tema crea y gestiona automáticamente las 4 páginas estáticas institucionales y legales indispensables para tu emisora:

1. **Acerca de nosotros** (`/acerca-de-nosotros/`): Historia de la radio, calidad de sonido HD 320k, equipo de cabina (Miguel 47) y comunidad global de oyentes.
2. **Contáctenos** (`/contactenos/`): Botón directo a WhatsApp de cabina, correo comercial de publicidad (`contacto@klkradio47.com`, `publicidad@klkradio47.com`), horarios de emisión y redes sociales.
3. **Política de privacidad** (`/politica-de-privacidad/`): Tratamiento de datos de streaming, mensajes del muro de oyentes, almacenamiento local de volumen/votos y derechos RGPD.
4. **Términos del servicio** (`/terminos-del-servicio/`): Normas de convivencia del muro, votación en El Termómetro Latino y aviso sobre eventos externos.

### ¿Dónde se visualizan en la web?
* **Menú Superior Web:** Accesos directos **"Acerca de"** y **"Contacto"** en la barra principal.
* **Menú Móvil Desplegable:** Accesos directos a las 4 páginas.
* **Pie de Página (Footer de 4 Columnas):** Rediseñado de extremo a extremo con separación inferior generosa (`pb-40`), lo que garantiza que la barra flotante de reproducción de audio nunca tape los enlaces ni el copyright.

### ¿Cómo editar el contenido de las páginas?
* Ve al menú izquierdo de WordPress en **Páginas > Todas las páginas**.
* Haz clic sobre cualquiera de ellas para modificar textos, correos o teléfonos usando el editor de WordPress.

### Configurar el Footer en el Personalizador:
1. Ve a **Apariencia > Personalizar > KLK Radio 47 - Configuración > 9. Pie de Página y Páginas Estáticas**.
2. Puedes editar:
   * **Texto de Copyright:** (usa `{year}` para que el año se actualice solo).
   * **Enlaces personalizados:** Si deseas redirigir alguna de las páginas a una URL externa.

---

## 🎧 14. Barra de Reproducción Persistente Flotante (Dock Player)

Ubicada en la parte inferior de la pantalla, permanece visible en todo momento:

* **Streaming ininterrumpido:** La radio sigue sonando sin cortes mientras el usuario navega entre la portada y las páginas estáticas.
* **Visualizador de espectro:** Ecualizador gráfico animado al reproducir.
* **Control de volumen interactivo:** Barra deslizable con botón de silencio y memoria en el navegador (LocalStorage).
* **Metadatos en vivo:** Muestra la carátula, título y artista del tema actual.

---

## 🛠️ 15. Preguntas Frecuentes y Solución de Problemas (Troubleshooting)

### ¿Qué hacer si la radio no suena al dar clic en Reproducir?
1. Verifica que tu URL de streaming use **HTTPS** (`https://srv1.streamingradio.ar/8380/stream`). Los navegadores modernos bloquean el contenido mixto (HTTP en webs HTTPS).
2. Comprueba que el servidor ShoutCast esté emitiendo en directo y con el puerto `8380` abierto.
3. Prueba la URL de audio directamente en una pestaña de tu navegador para descartar bloqueos de tu proveedor de hosting.

### ¿Qué hacer si un enlace a una página estática o evento da error 404?
1. En tu panel de WordPress, ve a **Ajustes > Enlaces permanentes**.
2. Asegúrate de tener seleccionada la opción **"Nombre de la entrada"** (`/%postname%/`).
3. Haz clic en el botón azul **"Guardar cambios"** (esto refresca la tabla de rutas de WordPress y soluciona cualquier error 404).

### ¿Cómo actualizar el tema sin perder mis cambios?
* Todos tus contenidos (eventos creados, programas, votos del ranking, saludos del muro y textos del personalizador) se guardan en la base de datos de WordPress.
* Al actualizar el tema mediante `klk-radio-47.zip`, tus datos se mantienen al 100%.

---

## 📦 16. Archivos de Instalación Listos para Subir

En la carpeta principal de tu proyecto tienes disponibles:

* **`klk-radio-47.zip`**: Archivo maestro del tema actualizado a la versión **1.0.11**, listo para subir e instalar en WordPress.
* **`fuego-fm.zip`**: Versión espejo para compatibilidad si tu carpeta de WordPress utiliza ese nombre.
