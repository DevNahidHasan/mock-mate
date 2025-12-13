@extends('layouts.main')

@section('content')
<style>
    .expert-hero {
        min-height: 100vh;
        padding: 7rem 1.5rem 4rem;
        background: radial-gradient(circle at top, rgba(251, 146, 60, 0.1), transparent 55%);
        font-family: "Segoe UI", system-ui, -apple-system, BlinkMacSystemFont, sans-serif;
    }

    .expert-container {
        max-width: 1200px;
        margin: 0 auto;
    }

    .expert-hero h1 {
        font-size: 2.75rem;
        color: #0f172a;
        margin-bottom: 0.75rem;
        text-align: center;
    }

    .expert-hero p {
        color: #475569;
        font-size: 1.1rem;
        max-width: 720px;
        margin: 0 auto 2.5rem;
        text-align: center;
    }

    .expert-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 1.5rem;
    }

    .expert-card {
        background: #fff;
        border-radius: 1.25rem;
        padding: 1.5rem;
        box-shadow: 0 25px 80px rgba(15, 23, 42, 0.08);
        border: 1px solid #f1f5f9;
    }

    .expert-card h2 {
        font-size: 1.35rem;
        color: #0f172a;
        margin-bottom: 1rem;
    }

    label {
        display: block;
        margin-bottom: 0.45rem;
        font-weight: 600;
        color: #475569;
    }

    select,
    input,
    textarea {
        width: 100%;
        padding: 0.85rem 1rem;
        border-radius: 0.85rem;
        border: 1px solid #d1d5db;
        background: #f8fafc;
        font-size: 1rem;
        transition: border 0.2s ease, box-shadow 0.2s ease;
        margin-bottom: 1rem;
        box-sizing: border-box;
    }

    select:focus,
    input:focus,
    textarea:focus {
        outline: none;
        border-color: #f97316;
        box-shadow: 0 0 0 3px rgba(249, 115, 22, 0.25);
        background: #fff;
    }

    .expert-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.4rem;
        background: linear-gradient(135deg, #fb923c, #f97316);
        color: #fff;
        border: none;
        border-radius: 999px;
        padding: 0.85rem 1.6rem;
        font-weight: 600;
        cursor: pointer;
        transition: transform 0.15s ease, box-shadow 0.15s ease;
    }

    .expert-btn.secondary {
        background: transparent;
        color: #0f172a;
        border: 1px solid #e2e8f0;
        box-shadow: none;
    }

    .expert-btn:active {
        transform: scale(0.97);
    }

    .call-stage {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    .video-box {
        position: relative;
        background: #0f172a;
        border-radius: 1.25rem;
        aspect-ratio: 4 / 3;
        overflow: hidden;
        box-shadow: inset 0 0 40px rgba(15, 23, 42, 0.5);
    }

    video {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .video-label {
        position: absolute;
        top: 1rem;
        left: 1rem;
        padding: 0.35rem 0.85rem;
        border-radius: 999px;
        background: rgba(15, 23, 42, 0.65);
        color: #fff;
        font-size: 0.85rem;
        letter-spacing: 0.04em;
    }

    .session-info {
        display: grid;
        gap: 1rem;
    }

    .session-info textarea {
        min-height: 90px;
        font-family: "Source Code Pro", Consolas, monospace;
    }

    .session-hint {
        font-size: 0.9rem;
        color: #475569;
        background: #fff7ed;
        border-radius: 0.85rem;
        padding: 0.85rem 1rem;
    }

    .status-chip {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.35rem 0.85rem;
        border-radius: 999px;
        font-size: 0.9rem;
        font-weight: 600;
        background: #e0f2fe;
        color: #0369a1;
        margin-bottom: 0.75rem;
    }

    .status-chip.active {
        background: #dcfce7;
        color: #15803d;
    }

    @media (max-width: 768px) {
        .expert-hero h1 {
            font-size: 2.1rem;
        }
    }
</style>

<section class="expert-hero">
    <div class="expert-container">
        <h1>Expert-Led Live Interviews</h1>
        <p>Pair up with a real industry interviewer via secure video, practice in realistic scenarios, and get instant coaching for your chosen role and seniority.</p>

        <div class="expert-grid">
            <div class="expert-card">
                <span class="status-chip" id="sessionStatus">Waiting for session</span>
                <h2>Pick Your Expert Track</h2>
                <label for="expertRole">Role</label>
                <select id="expertRole">
                    <option value="frontend">Frontend Engineer</option>
                    <option value="backend">Backend Engineer</option>
                    <option value="datascience">Data Scientist</option>
                    <option value="product">Product Manager</option>
                    <option value="uiux">UI/UX Designer</option>
                </select>

                <label for="expertLevel">Level</label>
                <select id="expertLevel">
                    <option value="junior">Junior</option>
                    <option value="mid">Mid-Level</option>
                    <option value="senior">Senior</option>
                    <option value="lead">Lead</option>
                </select>

                <label for="sessionCode">Session Code</label>
                <input id="sessionCode" placeholder="Share this code with your expert" />

                <div class="session-hint">
                    <strong>Tip:</strong> Start the call, copy the generated offer, and send it to your expert. They’ll respond with an answer SDP that you paste below to finalize the connection.
                </div>

                <div style="display:flex;gap:0.75rem;flex-wrap:wrap;">
                    <button class="expert-btn" id="initSessionBtn">Start Session</button>
                    <button class="expert-btn secondary" id="endSessionBtn">End Session</button>
                </div>
            </div>

            <div class="expert-card">
                <h2>Live Video Stage</h2>
                <div class="call-stage">
                    <div class="video-box">
                        <video id="localVideo" autoplay playsinline muted></video>
                        <div class="video-label">You</div>
                    </div>
                    <div class="video-box">
                        <video id="remoteVideo" autoplay playsinline></video>
                        <div class="video-label">Expert</div>
                    </div>
                </div>
                <div style="display:flex;gap:0.75rem;flex-wrap:wrap;">
                    <button class="expert-btn" id="enableCamBtn">Enable Camera & Mic</button>
                    <button class="expert-btn secondary" id="muteBtn">Mute</button>
                    <button class="expert-btn secondary" id="cameraBtn">Turn Camera Off</button>
                </div>
            </div>

            <div class="expert-card" style="grid-column: span 2;">
                <h2>Peer-to-Peer Handshake</h2>
                <div class="session-info">
                    <div>
                        <label for="offerSDP">Interview Offer (Host)</label>
                        <textarea id="offerSDP" placeholder="Once you create a session, copy this entire block and send it to your expert partner."></textarea>
                        <button class="expert-btn" id="createOfferBtn">Create Offer</button>
                    </div>
                    <div>
                        <label for="answerSDP">Expert Answer (Guest)</label>
                        <textarea id="answerSDP" placeholder="Paste the expert’s answer SDP or generate one if you are the expert."></textarea>
                        <div style="display:flex;gap:0.75rem;flex-wrap:wrap;">
                            <button class="expert-btn secondary" id="acceptOfferBtn">I’m the Expert: Generate Answer</button>
                            <button class="expert-btn" id="completeLinkBtn">Finalize Connection</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    const expertRole = document.getElementById('expertRole');
    const expertLevel = document.getElementById('expertLevel');
    const sessionCodeInput = document.getElementById('sessionCode');
    const sessionStatus = document.getElementById('sessionStatus');

    const localVideo = document.getElementById('localVideo');
    const remoteVideo = document.getElementById('remoteVideo');

    const offerSDP = document.getElementById('offerSDP');
    const answerSDP = document.getElementById('answerSDP');

    const initSessionBtn = document.getElementById('initSessionBtn');
    const endSessionBtn = document.getElementById('endSessionBtn');
    const enableCamBtn = document.getElementById('enableCamBtn');
    const muteBtn = document.getElementById('muteBtn');
    const cameraBtn = document.getElementById('cameraBtn');
    const createOfferBtn = document.getElementById('createOfferBtn');
    const acceptOfferBtn = document.getElementById('acceptOfferBtn');
    const completeLinkBtn = document.getElementById('completeLinkBtn');

    let localStream = null;
    let isMuted = false;
    let isCameraOff = false;

    const peerConfig = {
        iceServers: [
            { urls: 'stun:stun.l.google.com:19302' }
        ]
    };

    let peerConnection = new RTCPeerConnection(peerConfig);

    const updateStatus = (text, active = false) => {
        sessionStatus.textContent = text;
        sessionStatus.classList.toggle('active', active);
    };

    const resetPeerConnection = () => {
        if (peerConnection) {
            peerConnection.ontrack = null;
            peerConnection.onicecandidate = null;
            peerConnection.close();
        }
        peerConnection = new RTCPeerConnection(peerConfig);
        peerConnection.ontrack = (event) => {
            remoteVideo.srcObject = event.streams[0];
        };
        peerConnection.onicecandidate = (event) => {
            if (event.candidate) {
                // candidates are baked into SDP once gathering completes
                return;
            }
            if (peerConnection.localDescription?.type === 'offer') {
                offerSDP.value = JSON.stringify(peerConnection.localDescription);
            } else if (peerConnection.localDescription?.type === 'answer') {
                answerSDP.value = JSON.stringify(peerConnection.localDescription);
            }
        };

        if (localStream) {
            localStream.getTracks().forEach(track => peerConnection.addTrack(track, localStream));
        }
    };

    const waitForICE = () => {
        if (peerConnection.iceGatheringState === 'complete') return Promise.resolve();
        return new Promise(resolve => {
            const checkState = () => {
                if (peerConnection.iceGatheringState === 'complete') {
                    peerConnection.removeEventListener('icegatheringstatechange', checkState);
                    resolve();
                }
            };
            peerConnection.addEventListener('icegatheringstatechange', checkState);
        });
    };

    const enableLocalMedia = async () => {
        if (localStream) return;
        try {
            localStream = await navigator.mediaDevices.getUserMedia({ video: true, audio: true });
            localVideo.srcObject = localStream;
            localStream.getTracks().forEach(track => peerConnection.addTrack(track, localStream));
            updateStatus('Camera ready. Waiting for connection…');
        } catch (error) {
            alert('Unable to access camera/microphone. Check permissions.');
        }
    };

    enableCamBtn.addEventListener('click', enableLocalMedia);

    muteBtn.addEventListener('click', () => {
        if (!localStream) return;
        isMuted = !isMuted;
        localStream.getAudioTracks().forEach(track => {
            track.enabled = !isMuted;
        });
        muteBtn.textContent = isMuted ? 'Unmute' : 'Mute';
    });

    cameraBtn.addEventListener('click', () => {
        if (!localStream) return;
        isCameraOff = !isCameraOff;
        localStream.getVideoTracks().forEach(track => {
            track.enabled = !isCameraOff;
        });
        cameraBtn.textContent = isCameraOff ? 'Turn Camera On' : 'Turn Camera Off';
    });

    initSessionBtn.addEventListener('click', () => {
        const code = sessionCodeInput.value || `MM-${crypto.randomUUID().slice(0, 8).toUpperCase()}`;
        sessionCodeInput.value = code;
        updateStatus(`Session ${code} created for ${expertRole.value} (${expertLevel.value})`, true);
    });

    endSessionBtn.addEventListener('click', () => {
        offerSDP.value = '';
        answerSDP.value = '';
        sessionCodeInput.value = '';
        updateStatus('Session ended');
        resetPeerConnection();
    });

    createOfferBtn.addEventListener('click', async () => {
        if (!localStream) {
            await enableLocalMedia();
        }
        resetPeerConnection();
        const offer = await peerConnection.createOffer();
        await peerConnection.setLocalDescription(offer);
        await waitForICE();
        updateStatus('Offer generated. Share it with your expert.', true);
    });

    acceptOfferBtn.addEventListener('click', async () => {
        if (!offerSDP.value.trim()) {
            alert('Paste the host offer SDP first.');
            return;
        }
        if (!localStream) {
            await enableLocalMedia();
        }
        resetPeerConnection();
        const hostOffer = JSON.parse(offerSDP.value.trim());
        await peerConnection.setRemoteDescription(new RTCSessionDescription(hostOffer));
        const answer = await peerConnection.createAnswer();
        await peerConnection.setLocalDescription(answer);
        await waitForICE();
        updateStatus('Answer ready. Send it back to the host.', true);
    });

    completeLinkBtn.addEventListener('click', async () => {
        if (!answerSDP.value.trim()) {
            alert('Paste the expert answer SDP first.');
            return;
        }
        const remoteAnswer = JSON.parse(answerSDP.value.trim());
        await peerConnection.setRemoteDescription(new RTCSessionDescription(remoteAnswer));
        updateStatus('Interview room live! Happy interviewing!', true);
    });

    // Initialize default state
    resetPeerConnection();
</script>
@endsection

