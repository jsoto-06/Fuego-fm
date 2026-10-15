/**
 * Fuego FM - Interactive Radio & Audio Streaming Engine
 * Handles live playback, station switching, voting, shoutouts wall, and modals.
 */

(function () {
  'use strict';

  // Global player state
  const state = {
    isPlaying: false,
    currentStation: {
      id: 'master',
      title: 'Tití Me Preguntó',
      artist: 'Bad Bunny · Un Verano Sin Ti',
      cover: '',
      streamUrl: '',
      genre: 'Urbano Latino HD',
      dj: 'DJ Mateo & Sofía Santos'
    },
    audio: null,
    volume: 0.8,
    isMuted: false,
    duration: 0,
    currentTime: 0,
    timerInterval: null
  };

  // Default preset streams
  const defaultStreams = {
    master: 'https://srv1.streamingradio.ar/8380/stream',
    dial_1: 'https://srv1.streamingradio.ar/8380/stream',
    dial_2: 'https://playerservices.streamtheworld.com/api/livestream-redirect/LOS40_SC',
    dial_3: 'https://playerservices.streamtheworld.com/api/livestream-redirect/LOS40_URBAN_SC',
    dial_4: 'https://playerservices.streamtheworld.com/api/livestream-redirect/LOS40_DANCE_SC',
    dial_5: 'https://playerservices.streamtheworld.com/api/livestream-redirect/LOS40_SC',
    dial_6: 'https://playerservices.streamtheworld.com/api/livestream-redirect/LOS40_CLASSIC_SC'
  };

  // Toast Notification System
  function showToast(message, icon = 'info') {
    let container = document.getElementById('fuego-toast-container');
    if (!container) {
      container = document.createElement('div');
      container.id = 'fuego-toast-container';
      document.body.appendChild(container);
    }

    const toast = document.createElement('div');
    toast.className = 'fuego-toast';
    toast.innerHTML = `
      <span class="material-symbols-outlined text-primary-container text-xl">${icon}</span>
      <span>${message}</span>
    `;

    container.appendChild(toast);
    requestAnimationFrame(() => {
      toast.classList.add('show');
    });

    setTimeout(() => {
      toast.classList.remove('show');
      setTimeout(() => {
        if (toast.parentNode) toast.parentNode.removeChild(toast);
      }, 350);
    }, 4000);
  }

  // Audio Engine Initialization
  function initAudio() {
    state.audio = document.getElementById('fuego-live-audio');
    if (!state.audio) {
      state.audio = new Audio();
      state.audio.id = 'fuego-live-audio';
      state.audio.preload = 'none';
      document.body.appendChild(state.audio);
    }

    // Set initial stream URL from data attribute or fallback
    const configStream = window.fuegoThemeConfig ? window.fuegoThemeConfig.streamUrl : null;
    state.currentStation.streamUrl = configStream || defaultStreams.master;
    state.audio.src = state.currentStation.streamUrl;

    // Load saved volume
    const savedVol = localStorage.getItem('fuego_volume');
    if (savedVol !== null) {
      state.volume = parseFloat(savedVol);
    }
    state.audio.volume = state.volume;
    updateVolumeUI();

    // Event listeners on HTML5 audio
    state.audio.addEventListener('play', () => {
      state.isPlaying = true;
      updatePlaybackUI();
      startLiveTimer();
    });

    state.audio.addEventListener('pause', () => {
      state.isPlaying = false;
      updatePlaybackUI();
      stopLiveTimer();
    });

    state.audio.addEventListener('waiting', () => {
      updatePlaybackUI(true); // buffering state
    });

    state.audio.addEventListener('playing', () => {
      state.isPlaying = true;
      updatePlaybackUI();
    });

    state.audio.addEventListener('error', (e) => {
      console.warn('Fuego FM Stream notice: Fallback stream activated.', e);
      // If error occurs, try fallback stream smoothly
      if (state.audio.src !== defaultStreams.master) {
        state.audio.src = defaultStreams.master;
        if (state.isPlaying) state.audio.play().catch(() => {});
      }
    });

    state.audio.addEventListener('timeupdate', () => {
      updateTimelineProgress();
    });
  }

  // Timer simulation for live broadcast elapsed time
  function startLiveTimer() {
    stopLiveTimer();
    state.timerInterval = setInterval(() => {
      state.currentTime += 1;
      updateTimeDisplay(state.currentTime);
    }, 1000);
  }

  function stopLiveTimer() {
    if (state.timerInterval) {
      clearInterval(state.timerInterval);
      state.timerInterval = null;
    }
  }

  function formatTime(seconds) {
    const mins = Math.floor(seconds / 60);
    const secs = Math.floor(seconds % 60);
    return `${mins.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`;
  }

  function updateTimeDisplay(curSecs) {
    const timeLabels = document.querySelectorAll('.fuego-current-time');
    timeLabels.forEach(el => {
      el.textContent = formatTime(curSecs);
    });
  }

  function updateTimelineProgress() {
    if (state.audio && state.audio.duration && !isNaN(state.audio.duration)) {
      const pct = (state.audio.currentTime / state.audio.duration) * 100;
      const progressBars = document.querySelectorAll('.fuego-progress-bar-fill');
      progressBars.forEach(bar => {
        bar.style.width = `${pct}%`;
      });
      updateTimeDisplay(state.audio.currentTime);
    }
  }

  // Update UI Elements across Master Hero Player & Bottom Dock Player
  function updatePlaybackUI(isBuffering = false) {
    const playIcons = document.querySelectorAll('.fuego-play-icon');
    const eqBarsContainer = document.querySelectorAll('.fuego-eq-visualizer');
    const bottomWaveforms = document.querySelectorAll('.waveform-bar');
    const vinylCovers = document.querySelectorAll('.fuego-vinyl-art');
    const livePills = document.querySelectorAll('.fuego-live-pulse');

    playIcons.forEach(icon => {
      if (isBuffering) {
        icon.textContent = 'hourglass_top';
      } else if (state.isPlaying) {
        icon.textContent = 'pause';
      } else {
        icon.textContent = 'play_arrow';
      }
    });

    eqBarsContainer.forEach(eq => {
      if (state.isPlaying) {
        eq.classList.remove('eq-paused');
      } else {
        eq.classList.add('eq-paused');
      }
    });

    bottomWaveforms.forEach(bar => {
      if (state.isPlaying) {
        bar.classList.remove('paused');
      } else {
        bar.classList.add('paused');
      }
    });

    vinylCovers.forEach(vinyl => {
      if (state.isPlaying) {
        vinyl.classList.add('vinyl-spin');
        vinyl.classList.remove('paused');
      } else {
        vinyl.classList.add('paused');
      }
    });
  }

  // Toggle Play / Pause
  function togglePlay() {
    if (!state.audio) initAudio();

    if (state.isPlaying) {
      state.audio.pause();
    } else {
      const playPromise = state.audio.play();
      if (playPromise !== undefined) {
        playPromise.catch(error => {
          console.warn('Playback error, user gesture required:', error);
          showToast('Haz clic de nuevo para iniciar la transmisión en vivo', 'play_circle');
        });
      }
    }
  }

  // Switch Station Dial
  function tuneToDial(dialData) {
    if (!state.audio) initAudio();

    state.currentStation = {
      ...state.currentStation,
      ...dialData
    };

    // Update Bottom Dock Metadata
    const dockTitle = document.getElementById('fuego-dock-title');
    const dockArtist = document.getElementById('fuego-dock-artist');
    const dockDialTag = document.getElementById('fuego-dock-tag');
    const dockCover = document.getElementById('fuego-dock-cover');

    if (dockTitle) dockTitle.textContent = dialData.title || 'Fuego FM';
    if (dockArtist) dockArtist.textContent = dialData.dj || dialData.genre || 'Música Latina en Vivo';
    if (dockDialTag) dockDialTag.textContent = dialData.tag || dialData.title;
    if (dockCover && dialData.cover) {
      dockCover.src = dialData.cover;
    }

    // Set Audio Source and play
    const targetUrl = dialData.streamUrl || defaultStreams[dialData.id] || defaultStreams.master;
    state.audio.src = targetUrl;
    state.audio.play().then(() => {
      state.isPlaying = true;
      updatePlaybackUI();
      showToast(`Sintonizando ${dialData.title}...`, 'radio');
    }).catch(err => {
      console.warn('Error playing station:', err);
    });

    // Update active state in dial buttons
    document.querySelectorAll('.fuego-dial-btn').forEach(btn => {
      const btnDialId = btn.getAttribute('data-dial-id');
      const defaultText = btn.getAttribute('data-btn-text') || 'Sintonizar';
      if (btnDialId === dialData.id) {
        btn.classList.add('bg-secondary-container', 'text-on-secondary-container');
        btn.classList.remove('bg-surface-container-high', 'bg-primary-container');
        btn.innerHTML = '<span class="material-symbols-outlined text-base">graphic_eq</span> En El Aire';
      } else {
        btn.classList.remove('bg-secondary-container', 'text-on-secondary-container');
        btn.innerHTML = `<span class="material-symbols-outlined text-base">play_arrow</span> ${defaultText}`;
      }
    });
  }

  // Volume Slider & Mute
  function setVolume(val) {
    state.volume = Math.max(0, Math.min(1, val));
    if (state.audio) state.audio.volume = state.volume;
    localStorage.setItem('fuego_volume', state.volume);
    state.isMuted = state.volume === 0;
    updateVolumeUI();
  }

  function toggleMute() {
    if (!state.audio) return;
    state.isMuted = !state.isMuted;
    state.audio.muted = state.isMuted;
    updateVolumeUI();
  }

  function updateVolumeUI() {
    const volInputs = document.querySelectorAll('.fuego-volume-slider');
    const volBars = document.querySelectorAll('.fuego-volume-bar-fill');
    const volIcons = document.querySelectorAll('.fuego-volume-icon');

    const pct = state.isMuted ? 0 : state.volume * 100;

    volInputs.forEach(input => {
      input.value = pct;
    });

    volBars.forEach(bar => {
      bar.style.width = `${pct}%`;
    });

    volIcons.forEach(icon => {
      if (state.isMuted || state.volume === 0) {
        icon.textContent = 'volume_off';
      } else if (state.volume < 0.4) {
        icon.textContent = 'volume_down';
      } else {
        icon.textContent = 'volume_up';
      }
    });
  }

  // Dial Genre Filter Tabs
  function initDialFilters() {
    const filterButtons = document.querySelectorAll('.fuego-filter-pill');
    const dialCards = document.querySelectorAll('.fuego-dial-card');

    filterButtons.forEach(btn => {
      btn.addEventListener('click', () => {
        // Active class toggle
        filterButtons.forEach(b => {
          b.classList.remove('bg-primary-container', 'text-white', 'shadow-md');
          b.classList.add('bg-surface-container-high', 'text-on-surface-variant');
        });
        btn.classList.remove('bg-surface-container-high', 'text-on-surface-variant');
        btn.classList.add('bg-primary-container', 'text-white', 'shadow-md');

        const filter = btn.getAttribute('data-filter') || 'all';

        dialCards.forEach(card => {
          const category = card.getAttribute('data-category') || '';
          if (filter === 'all' || category.toLowerCase().includes(filter.toLowerCase())) {
            card.style.display = '';
            card.style.opacity = '1';
          } else {
            card.style.display = 'none';
          }
        });
      });
    });
  }

  // Voting System for 'El Termómetro Latino'
  function initVoting() {
    const voteButtons = document.querySelectorAll('.fuego-vote-btn');

    voteButtons.forEach(btn => {
      btn.addEventListener('click', (e) => {
        e.preventDefault();
        const trackId = btn.getAttribute('data-track-id');
        const trackTitle = btn.getAttribute('data-track-title') || 'el tema';
        const votesCounter = document.getElementById(`track-votes-${trackId}`);

        // Check localStorage to prevent spamming
        const votedKey = `fuego_voted_${trackId}`;
        if (localStorage.getItem(votedKey)) {
          showToast(`Ya has votado por "${trackTitle}" hoy. ¡Vuelve en 24 horas!`, 'thumb_up');
          return;
        }

        // Optimistic UI update
        btn.disabled = true;
        btn.classList.add('opacity-50');
        btn.textContent = '¡Votado!';

        if (votesCounter) {
          const currentText = votesCounter.textContent.replace(/[^0-9]/g, '');
          const currentVotes = parseInt(currentText, 10) || 84000;
          const newVotes = currentVotes + 1;
          votesCounter.textContent = `${newVotes.toLocaleString()} Votos registrados`;
        }

        localStorage.setItem(votedKey, '1');
        showToast(`¡Gracias! Tu voto por "${trackTitle}" fue registrado en directo.`, 'local_fire_department');

        // Send AJAX to WordPress if configured
        if (window.fuegoAjax && window.fuegoAjax.ajax_url) {
          const formData = new FormData();
          formData.append('action', 'fuego_vote_track');
          formData.append('nonce', window.fuegoAjax.nonce);
          formData.append('track_id', trackId);

          fetch(window.fuegoAjax.ajax_url, {
            method: 'POST',
            body: formData
          }).then(res => res.json()).then(data => {
            if (data && data.success && data.data && data.data.new_votes && votesCounter) {
              votesCounter.textContent = `${parseInt(data.data.new_votes, 10).toLocaleString()} Votos registrados`;
            }
          }).catch(err => {
            console.warn('Voting AJAX notice:', err);
          });
        }
      });
    });
  }

  // Shoutout Wall Live Posting
  function initShoutouts() {
    const shoutoutForm = document.getElementById('fuego-shoutout-form');
    const shoutoutInput = document.getElementById('fuego-shoutout-input');
    const shoutoutGrid = document.getElementById('fuego-shoutouts-grid');

    if (!shoutoutForm || !shoutoutInput) return;

    shoutoutForm.addEventListener('submit', (e) => {
      e.preventDefault();
      const message = shoutoutInput.value.trim();
      if (!message) {
        showToast('Por favor escribe un mensaje o saludo.', 'warning');
        shoutoutInput.focus();
        return;
      }

      // Optimistic Card Insertion
      const newCard = document.createElement('div');
      newCard.className = 'bg-surface-container p-4 rounded-xl flex flex-col justify-between border border-primary-container/30 transition-all';
      newCard.innerHTML = `
        <div>
          <div class="flex items-center justify-between mb-2">
            <span class="font-label-sm text-label-sm font-bold text-on-surface">Tú (En Vivo)</span>
            <span class="font-label-sm text-label-sm text-primary-container">Transmitiendo</span>
          </div>
          <p class="font-body-sm text-body-sm text-on-surface-variant">
            "${message.replace(/</g, '&lt;').replace(/>/g, '&gt;')}"
          </p>
        </div>
        <div class="flex items-center justify-between mt-3 pt-2 text-xs text-outline border-t border-white/5">
          <span>Ahora mismo</span>
          <span class="text-primary flex items-center gap-1 cursor-pointer">
            <span class="material-symbols-outlined text-xs">favorite</span> 1
          </span>
        </div>
      `;

      if (shoutoutGrid) {
        shoutoutGrid.insertBefore(newCard, shoutoutGrid.firstChild);
      }

      shoutoutInput.value = '';
      showToast('¡Tu saludo fue enviado a cabina! Saldrá al aire en breve.', 'check_circle');

      // Send to WordPress backend via AJAX
      if (window.fuegoAjax && window.fuegoAjax.ajax_url) {
        const formData = new FormData();
        formData.append('action', 'fuego_send_shoutout');
        formData.append('nonce', window.fuegoAjax.nonce);
        formData.append('message', message);

        fetch(window.fuegoAjax.ajax_url, {
          method: 'POST',
          body: formData
        }).then(res => res.json()).catch(err => {
          console.warn('Shoutout AJAX notice:', err);
        });
      }
    });

    // Likes on shoutouts
    document.addEventListener('click', (e) => {
      const likeBtn = e.target.closest('.fuego-like-shoutout');
      if (likeBtn) {
        const countSpan = likeBtn.querySelector('.fuego-like-count');
        if (countSpan) {
          let count = parseInt(countSpan.textContent, 10) || 0;
          count += 1;
          countSpan.textContent = count;
          likeBtn.classList.add('text-primary');
          showToast('¡Me gusta agregado!', 'favorite');
        }
      }
    });
  }

  // Song Request Modal ("Pedir Canción")
  function initRequestModal() {
    const openBtns = document.querySelectorAll('.fuego-open-request-modal');
    const modal = document.getElementById('fuego-request-modal');
    const closeBtn = document.getElementById('fuego-close-request-modal');
    const form = document.getElementById('fuego-request-form');

    if (!modal) return;

    openBtns.forEach(btn => {
      btn.addEventListener('click', (e) => {
        e.preventDefault();
        modal.classList.add('is-open');
      });
    });

    if (closeBtn) {
      closeBtn.addEventListener('click', () => {
        modal.classList.remove('is-open');
      });
    }

    modal.addEventListener('click', (e) => {
      if (e.target === modal) {
        modal.classList.remove('is-open');
      }
    });

    if (form) {
      form.addEventListener('submit', (e) => {
        e.preventDefault();
        const songName = (document.getElementById('fuego-req-song') || {}).value || '';
        const artistName = (document.getElementById('fuego-req-artist') || {}).value || '';

        modal.classList.remove('is-open');
        form.reset();
        showToast(`¡Solicitud recibida! "${songName} - ${artistName}" agregada a la lista de cabina.`, 'queue_music');

        if (window.fuegoAjax && window.fuegoAjax.ajax_url) {
          const formData = new FormData(form);
          formData.append('action', 'fuego_request_song');
          formData.append('nonce', window.fuegoAjax.nonce);
          fetch(window.fuegoAjax.ajax_url, {
            method: 'POST',
            body: formData
          }).catch(() => {});
        }
      });
    }
  }

  // Interactive Event Details Modal
  function initEventModal() {
    const modal = document.getElementById('fuego-event-modal');
    if (!modal) return;

    const imgEl = document.getElementById('fuego-ev-img');
    const tagEl = document.getElementById('fuego-ev-tag');
    const catEl = document.getElementById('fuego-ev-category');
    const titleEl = document.getElementById('fuego-ev-title');
    const dateEl = document.getElementById('fuego-ev-date');
    const timeEl = document.getElementById('fuego-ev-time');
    const venueEl = document.getElementById('fuego-ev-venue');
    const descEl = document.getElementById('fuego-ev-desc');
    const waBtn = document.getElementById('fuego-ev-whatsapp-btn');
    const tuneBtn = document.getElementById('fuego-ev-tune-btn');
    const closeBtn = document.getElementById('fuego-close-event-modal');

    function fullyDecodeHtml(str) {
      if (!str) return '';
      let s = str.trim();
      s = s.replace(/<!--\s*\/?wp:[^\>]*-->/gi, '');
      const txt = document.createElement('textarea');
      for (let i = 0; i < 2; i++) {
        if (s.includes('&lt;') || s.includes('&amp;') || s.includes('&gt;')) {
          txt.innerHTML = s;
          s = txt.value;
        } else {
          break;
        }
      }
      return s;
    }

    function openEventModal(eventData, sourceCard) {
      const cleanTitle = fullyDecodeHtml(eventData.title || '');
      const cleanTag = fullyDecodeHtml(eventData.tag || 'EVENTO LATINO');
      const cleanCat = fullyDecodeHtml(eventData.category || 'Música Latina');
      const cleanDate = fullyDecodeHtml(eventData.date || eventData.genre || '');
      const cleanTime = fullyDecodeHtml(eventData.time || eventData.listeners || '');
      const cleanVenue = fullyDecodeHtml(eventData.venue || eventData.dj || '');

      if (imgEl && eventData.image) imgEl.src = eventData.image;
      if (tagEl) tagEl.textContent = cleanTag;
      if (catEl) catEl.textContent = cleanCat;
      if (titleEl) titleEl.textContent = cleanTitle;
      if (dateEl) dateEl.textContent = cleanDate;
      if (timeEl) timeEl.textContent = cleanTime;
      if (venueEl) venueEl.textContent = cleanVenue;

      if (descEl) {
        let finalHtml = '';
        if (sourceCard) {
          const preEl = sourceCard.querySelector('.fuego-event-clean-html');
          if (preEl && preEl.innerHTML.trim().length > 0) {
            finalHtml = preEl.innerHTML;
          }
        }
        if (!finalHtml) {
          finalHtml = eventData.content || eventData.artists || '';
        }

        finalHtml = fullyDecodeHtml(finalHtml);

        // If the text does not contain any HTML tags, wrap in paragraphs
        if (finalHtml && !/<[a-z][\s\S]*>/i.test(finalHtml)) {
          const paragraphs = finalHtml.split(/\n\s*\n/).filter(p => p.trim().length > 0);
          finalHtml = paragraphs.map(p => `<p>${p.replace(/\n/g, '<br>')}</p>`).join('');
        }

        descEl.innerHTML = finalHtml;

        // Self-healing check: if descEl literally displays "<p>" or "</p>" as visible text
        if (descEl.innerHTML.includes('&lt;p') || descEl.innerHTML.includes('&lt;strong') || descEl.innerHTML.includes('&lt;br')) {
          const helper = document.createElement('textarea');
          helper.innerHTML = descEl.innerHTML;
          descEl.innerHTML = helper.value;
        }
        if (descEl.textContent.trim().startsWith('<p>') || descEl.textContent.trim().startsWith('<p ') || descEl.textContent.includes('</p>')) {
          descEl.innerHTML = descEl.textContent;
        }
      }

      // Direct WhatsApp Inquiry link with cleanly decoded title
      if (waBtn) {
        const rawPhone = (window.fuegoThemeConfig && window.fuegoThemeConfig.whatsappNumber) 
          ? window.fuegoThemeConfig.whatsappNumber 
          : '+1234567890';
        const cleanWa = rawPhone.replace(/[^0-9]/g, '');
        const eventMsg = encodeURIComponent(`¡Hola KLK Radio 47! Quisiera más información y entradas para: ${cleanTitle} 🎟️🔥`);
        waBtn.href = `https://wa.me/${cleanWa}?text=${eventMsg}`;
      }

      // Tune Radio button inside Event Modal
      if (tuneBtn) {
        tuneBtn.onclick = (e) => {
          e.preventDefault();
          const dialData = {
            id: eventData.id || 'dial_1',
            title: cleanTitle || 'KLK Radio 47',
            dj: cleanVenue || '',
            genre: cleanCat || '',
            cover: eventData.image || '',
            streamUrl: eventData.stream || defaultStreams.master
          };
          tuneToDial(dialData);
          closeEventModal();
        };
      }

      modal.classList.remove('opacity-0', 'pointer-events-none');
      document.body.classList.add('overflow-hidden');
    }

    function closeEventModal() {
      modal.classList.add('opacity-0', 'pointer-events-none');
      document.body.classList.remove('overflow-hidden');
    }

    if (closeBtn) {
      closeBtn.addEventListener('click', (e) => {
        e.preventDefault();
        closeEventModal();
      });
    }

    modal.addEventListener('click', (e) => {
      if (e.target === modal) {
        closeEventModal();
      }
    });

    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape') {
        closeEventModal();
      }
    });

    // Attach click listeners to cards and buttons
    document.querySelectorAll('.fuego-event-card').forEach(card => {
      let eventData = null;
      const scriptEl = card.querySelector('.fuego-event-data');
      if (scriptEl) {
        try {
          eventData = JSON.parse(scriptEl.textContent.trim());
        } catch (e) {
          console.warn('Could not parse event JSON data', e);
        }
      }

      if (!eventData) {
        eventData = {
          id: card.getAttribute('data-event-id') || 'event_1',
          title: card.querySelector('.fuego-dial-title')?.textContent.trim() || '',
          genre: card.querySelector('.fuego-dial-genre')?.textContent.trim() || '',
          category: card.getAttribute('data-category') || '',
          artists: card.querySelector('.font-body-sm')?.textContent.trim() || '',
          dj: card.querySelector('.fuego-dial-dj')?.textContent.trim() || '',
          listeners: card.querySelector('.material-symbols-outlined + span')?.textContent.trim() || '',
          image: card.querySelector('.fuego-dial-img')?.src || '',
          stream: card.querySelector('.fuego-dial-btn')?.getAttribute('data-stream-url') || ''
        };
      }

      card.addEventListener('click', (e) => {
        // If clicking a link that goes to an external page, let it proceed
        const btn = e.target.closest('.fuego-dial-btn');
        if (btn) {
          const streamUrl = btn.getAttribute('data-stream-url') || '';
          const isAudio = streamUrl && (
            streamUrl.includes('stream') ||
            streamUrl.includes('.mp3') ||
            streamUrl.includes('.aac') ||
            streamUrl.includes('.m3u8') ||
            streamUrl.includes(':8') ||
            streamUrl.includes('icecast') ||
            streamUrl.includes('shoutcast')
          );
          if (streamUrl && !isAudio && (streamUrl.startsWith('http://') || streamUrl.startsWith('https://'))) {
            window.open(streamUrl, '_blank');
            return;
          }
        }
        openEventModal(eventData, card);
      });
    });
  }

  // Voice Note Recording to Studio Simulation
  function initVoiceNoteWidget() {
    const recordBtn = document.querySelector('.fuego-record-voice-btn');
    if (!recordBtn) return;

    recordBtn.addEventListener('click', (e) => {
      e.preventDefault();
      // Prompt user or simulate countdown
      if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
        recordBtn.textContent = 'Grabando (15s)...';
        recordBtn.classList.add('bg-tertiary-container', 'animate-pulse');

        setTimeout(() => {
          recordBtn.textContent = '¡Enviada a Cabina!';
          recordBtn.classList.remove('bg-tertiary-container', 'animate-pulse');
          recordBtn.classList.add('bg-green-600');
          showToast('Nota de voz enviada exitosamente a los locutores.', 'mic');

          setTimeout(() => {
            recordBtn.textContent = 'Enviar';
            recordBtn.classList.remove('bg-green-600');
          }, 3000);
        }, 3500);
      } else {
        showToast('Para enviar notas de voz, abre la línea directa de WhatsApp.', 'chat');
      }
    });
  }

  // Share Station Button
  function initShareButtons() {
    const shareBtns = document.querySelectorAll('.fuego-share-btn');
    shareBtns.forEach(btn => {
      btn.addEventListener('click', (e) => {
        e.preventDefault();
        const shareData = {
          title: 'KLK Radio 47 | Sabor Latino',
          text: '¡Escucha KLK Radio 47 en directo con el mejor reggaetón, salsa y música urbana latina en 320kbps!',
          url: window.location.href
        };

        if (navigator.share) {
          navigator.share(shareData).catch(() => {});
        } else {
          navigator.clipboard.writeText(window.location.href).then(() => {
            showToast('¡Enlace de KLK Radio 47 copiado al portapapeles!', 'share');
          }).catch(() => {
            showToast('Comparte: ' + window.location.href, 'share');
          });
        }
      });
    });
  }

  // Live Now Playing & Metadata Poller (Shoutcast v2 & Icecast)
  function initNowPlayingPoller() {
    function fetchNowPlaying() {
      if (!window.fuegoAjax || !window.fuegoAjax.ajax_url) return;

      const url = `${window.fuegoAjax.ajax_url}?action=fuego_get_nowplaying`;
      fetch(url)
        .then(res => res.json())
        .then(res => {
          if (res && res.success && res.data) {
            const data = res.data;
            const heroTitle = document.getElementById('fuego-hero-track-title');
            const heroArtist = document.getElementById('fuego-hero-track-artist');
            const heroCover = document.getElementById('fuego-hero-album');
            const dockTitle = document.getElementById('fuego-dock-title');
            const dockArtist = document.getElementById('fuego-dock-artist');
            const dockCover = document.getElementById('fuego-dock-cover');

            if (heroTitle && data.title) heroTitle.textContent = data.title;
            if (heroArtist && data.artist) heroArtist.textContent = data.artist;
            if (dockTitle && data.title) dockTitle.textContent = data.title;
            if (dockArtist && data.artist) dockArtist.textContent = data.artist;

            if (data.cover) {
              if (heroCover && !heroCover.src.includes(data.cover)) heroCover.src = data.cover;
              if (dockCover && !dockCover.src.includes(data.cover)) dockCover.src = data.cover;
            }

            // Real-time Update for Recién Sonadas (Played History from Live Stream)
            if (data.recent_tracks && Array.isArray(data.recent_tracks) && data.recent_tracks.length > 0) {
              const recentList = document.getElementById('fuego-recent-plays-list');
              if (recentList) {
                let listHtml = '';
                data.recent_tracks.forEach(track => {
                  listHtml += `
                    <div class="flex items-center justify-between gap-2 p-2 rounded-lg bg-surface-container/60 hover:bg-surface-container transition-colors">
                      <div class="flex items-center gap-2.5 min-w-0">
                        <span class="font-label-sm text-label-sm text-on-surface-variant w-4 font-bold">${track.num}</span>
                        <div class="min-w-0">
                          <p class="font-title-md text-sm text-on-surface font-semibold truncate leading-tight">${track.title}</p>
                          <p class="font-body-sm text-xs text-on-surface-variant truncate">${track.artist}</p>
                        </div>
                      </div>
                      <span class="text-xs text-on-surface-variant flex-shrink-0">${track.time}</span>
                    </div>
                  `;
                });
                recentList.innerHTML = listHtml;
              }
            }
          }
        })
        .catch(() => {});
    }

    // Run immediately on page load
    fetchNowPlaying();
    // Poll every 12 seconds for seamless track updates
    setInterval(fetchNowPlaying, 12000);
  }

  // Mobile Navigation Drawer Toggle
  function initMobileMenu() {
    const menuToggle = document.getElementById('fuego-menu-toggle');
    const mobileMenu = document.getElementById('fuego-mobile-menu');

    if (menuToggle && mobileMenu) {
      menuToggle.addEventListener('click', () => {
        mobileMenu.classList.toggle('is-active');
        const icon = menuToggle.querySelector('.material-symbols-outlined');
        if (icon) {
          icon.textContent = mobileMenu.classList.contains('is-active') ? 'close' : 'menu';
        }
      });
    }
  }

  // Setup DOM Event Delegation & Listeners
  document.addEventListener('DOMContentLoaded', () => {
    initAudio();
    initNowPlayingPoller();

    // Play/Pause button triggers
    document.querySelectorAll('.fuego-toggle-play').forEach(btn => {
      btn.addEventListener('click', (e) => {
        e.preventDefault();
        togglePlay();
      });
    });

    // Dial Sintonizar / Action buttons
    document.querySelectorAll('.fuego-dial-btn').forEach(btn => {
      btn.addEventListener('click', (e) => {
        e.preventDefault();
        const card = btn.closest('.fuego-dial-card');
        if (!card) return;

        const streamUrl = btn.getAttribute('data-stream-url') || '';
        const isAudio = streamUrl && (
          streamUrl.includes('stream') ||
          streamUrl.includes('.mp3') ||
          streamUrl.includes('.aac') ||
          streamUrl.includes('.m3u8') ||
          streamUrl.includes(':8') ||
          streamUrl.includes(':80') ||
          streamUrl.includes('streaming') ||
          streamUrl.includes('icecast') ||
          streamUrl.includes('shoutcast')
        );

        // If it's a web link (e.g. event page, external article, tickets), open it directly
        if (streamUrl && !isAudio && (streamUrl.startsWith('http://') || streamUrl.startsWith('https://') || streamUrl.startsWith('/'))) {
          window.open(streamUrl, '_blank');
          return;
        }

        const dialData = {
          id: btn.getAttribute('data-dial-id') || 'dial_1',
          title: card.querySelector('.fuego-dial-title')?.textContent.trim() || 'KLK Radio 47',
          dj: card.querySelector('.fuego-dial-dj')?.textContent.trim() || '',
          genre: card.querySelector('.fuego-dial-genre')?.textContent.trim() || '',
          cover: card.querySelector('.fuego-dial-img')?.src || '',
          streamUrl: streamUrl
        };

        tuneToDial(dialData);
      });
    });

    // Volume sliders
    document.querySelectorAll('.fuego-volume-slider').forEach(slider => {
      slider.addEventListener('input', (e) => {
        setVolume(e.target.value / 100);
      });
    });

    // Volume mute toggles
    document.querySelectorAll('.fuego-volume-mute-btn').forEach(btn => {
      btn.addEventListener('click', (e) => {
        e.preventDefault();
        toggleMute();
      });
    });

    // Initialize all modular components
    initDialFilters();
    initEventModal();
    initVoting();
    initShoutouts();
    initRequestModal();
    initVoiceNoteWidget();
    initShareButtons();
    initMobileMenu();
  });

})();
