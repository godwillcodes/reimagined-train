<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package PiedmontGlobal
 */

get_header();
?>
<header class="relative w-full text-[#F9F8F6] overflow-hidden" style="background: linear-gradient(0deg, var(--Primary-Background, #1F3131), var(--Primary-Background, #1F3131)),
linear-gradient(1.48deg, rgba(0, 97, 85, 0) 72.24%, #006155 135.34%);
">
    <?php get_template_part('components/navigation/desktop'); ?>
    <?php get_template_part('components/navigation/mobile'); ?>

    <div class="w-full pt-[30%] lg:pt-[5%] px-6 lg:px-0 relative z-20 pb-10 lg:pb-60">
        <div class="text-start gap-y-4 max-w-7xl mx-auto">
            <h1 class="text-4xl py-5  md:text-5xl max-w-4xl font-extrabold  leading-[98%]">
                <?php the_title(); ?>
            </h1>

            <div class="text-[#F9F8F6] text-base font-light"><?php echo get_the_date(); ?></div>

            <div class="flex items-center gap-4 mt-10">
                <?php if ($image = get_field('author_image')): ?>
                <img src="<?php echo esc_url($image); ?>" alt="Profile"
                    class="w-[60px] h-[60px] object-cover object-center">
                <?php endif; ?>

                <div>
                    <?php if ($name = get_field('author_name')): ?>
                    <div class="text-[#F9F8F6] text-base font-bold">
                        <?php echo esc_html($name); ?>
                    </div>
                    <?php endif; ?>

                    <?php if ($designation = get_field('author_designation')): ?>
                    <div class="text-[#F9F8F6] text-base font-light">
                        <?php echo esc_html($designation); ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </div>
</header>


<section class=" lg:pt-0 pt-10">
    <div class="max-w-7xl mx-auto px-4 lg:px-0">
        <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>"
            class="w-full h-auto lg:h-[600px] shadow-sm relative z-10  mt-0 md:-mt-48 object-cover object-center">
    </div>
</section>

<section class="py-12 lg:py-20">
    <div class="max-w-7xl mx-auto px-6 lg:px-0">

        <!-- Text-to-Speech Player -->
        <?php
        $tts_content = get_the_content();
        $tts_content = wp_strip_all_tags(strip_shortcodes($tts_content));
        $tts_content = preg_replace('/\s+/', ' ', $tts_content);
        $tts_content = trim($tts_content);
        $tts_title = get_the_title();
        $tts_reading_time = max(1, round(str_word_count($tts_content) / 200));
        ?>
        <div id="sp" class="sp" data-post-id="<?php echo esc_attr(get_the_ID()); ?>">
            <div class="sp-inner">
                <!-- Cover art / icon -->
                <div class="sp-cover">
                    <div class="sp-cover-icon">
                        <svg viewBox="0 0 24 24" fill="none"><path d="M9 18V5l12-2v13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><circle cx="6" cy="18" r="3" stroke="currentColor" stroke-width="1.5"/><circle cx="18" cy="16" r="3" stroke="currentColor" stroke-width="1.5"/></svg>
                    </div>
                    <!-- Equalizer bars (visible when playing) -->
                    <div id="sp-eq" class="sp-eq" style="display:none;">
                        <span></span><span></span><span></span><span></span>
                    </div>
                </div>

                <!-- Track info + controls -->
                <div class="sp-body">
                    <div class="sp-meta">
                        <span class="sp-chip"><span class="sp-chip-dot"></span>Article audio</span>
                        <span class="sp-track-title"><?php echo esc_html($tts_title); ?></span>
                        <span class="sp-track-sub"><?php echo esc_html($tts_reading_time); ?> min listen</span>
                    </div>

                    <!-- Initial: generate row -->
                    <div id="sp-init" class="sp-init">
                        <button id="sp-gen" class="sp-play-big" aria-label="Listen to this article">
                            <svg viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg>
                        </button>
                        <div id="sp-loader" class="sp-loader" style="display:none;">
                            <div class="sp-spinner"></div>
                            <span>Generating...</span>
                        </div>
                    </div>

                    <!-- Player: shown after audio loads -->
                    <div id="sp-ctrl" class="sp-ctrl" style="display:none;">
                        <div class="sp-subline">
                            <span id="sp-cache" class="sp-cache" style="display:none;">Instant playback (cached)</span>
                        </div>
                        <div class="sp-ctrl-top">
                            <button id="sp-play" class="sp-play-big" aria-label="Play">
                                <svg id="sp-ico-play" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg>
                                <svg id="sp-ico-pause" viewBox="0 0 24 24" fill="currentColor" style="display:none;"><path d="M6 4h4v16H6zm8 0h4v16h-4z"/></svg>
                            </button>

                            <div class="sp-progress-area">
                                <span id="sp-cur" class="sp-time">0:00</span>
                                <div class="sp-bar-wrap">
                                    <div class="sp-bar-track">
                                        <div id="sp-bar-fill" class="sp-bar-fill"></div>
                                        <div id="sp-bar-dot" class="sp-bar-dot"></div>
                                    </div>
                                    <input type="range" id="sp-seek" class="sp-seek" min="0" max="1000" value="0" step="1">
                                </div>
                                <span id="sp-dur" class="sp-time">0:00</span>
                            </div>
                        </div>

                        <div class="sp-ctrl-btm">
                            <div class="sp-vol">
                                <button id="sp-vol-btn" class="sp-btn-sm" aria-label="Volume">
                                    <svg id="sp-vol-icon" viewBox="0 0 24 24" fill="currentColor"><path d="M3 9v6h4l5 5V4L7 9H3zm13.5 3A4.5 4.5 0 0014 8.97v6.06A4.5 4.5 0 0016.5 12zM14 3.23v2.06a6.51 6.51 0 010 13.42v2.06A8.5 8.5 0 0014 3.23z"/></svg>
                                    <svg id="sp-vol-mute" viewBox="0 0 24 24" fill="currentColor" style="display:none;"><path d="M16.5 12A4.5 4.5 0 0014 8.97v2.21l2.45 2.45c.03-.21.05-.43.05-.63zm2.5 0a6.4 6.4 0 01-.57 2.64L20 16.21A8.38 8.38 0 0021 12a8.5 8.5 0 00-7-8.37v2.06A6.51 6.51 0 0119 12zM4.27 3L3 4.27 7.73 9H3v6h4l5 5v-6.73l4.25 4.25c-.67.52-1.42.93-2.25 1.18v2.06a8.46 8.46 0 003.69-1.81L19.73 21 21 19.73l-9-9L4.27 3zM12 4L9.91 6.09 12 8.18V4z"/></svg>
                                </button>
                                <div class="sp-vol-bar-wrap">
                                    <div class="sp-vol-track">
                                        <div id="sp-vol-fill" class="sp-vol-fill" style="width:80%"></div>
                                        <div id="sp-vol-dot" class="sp-vol-dot" style="left:80%"></div>
                                    </div>
                                    <input type="range" id="sp-vol" class="sp-vol-range" min="0" max="100" value="80">
                                </div>
                            </div>
                            <button id="sp-dl" class="sp-btn-sm" aria-label="Download audio">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>        <?php 
      $content = get_post_field('post_content', get_the_ID());
      $word_count = str_word_count( wp_strip_all_tags( $content ) );
      $min_words_for_toc = 500; 
      
      // Check if content has headings (h2-h6) for TOC
      $has_headings = preg_match('/<h([2-6])(.*?)>(.*?)<\/h[2-6]>/', $content);
      $has_toc = ($word_count >= $min_words_for_toc && $has_headings);
    ?>

        <div class="grid grid-cols-1 <?php echo $has_toc ? 'lg:grid-cols-3 gap-12 lg:gap-12' : ''; ?>">

            <!-- TOC -->
            <?php if ($has_toc): ?>
            <aside class="hidden lg:block lg:col-span-1 lg:sticky lg:top-32 self-start order-1 lg:order-1">
                <div class="table-of-contents bg-white p-2  ">
                    <?php 
                    // Generate TOC if not already generated
                    if (empty($GLOBALS['pg_toc'])) {
                        pg_generate_toc($content);
                    }
                    echo $GLOBALS['pg_toc']; 
                    ?>
                </div>
            </aside>
            <?php endif; ?>

            <!-- Blog Content -->
            <article
                class="<?php echo $has_toc ? 'lg:col-span-2' : 'col-span-1'; ?> prose prose-lg max-w-none text-black order-2 lg:order-2">

                <?php the_content(); ?>
            </article>

        </div>
    </div>
</section>


<section class="pb-40 pt-20"
    style="background: linear-gradient(to bottom, #fff 0%, #F7F7F5 70%, #98C44180 85%, #00615580 100%);">

    <div class="max-w-3xl mx-auto px-8 lg:px-0 text-center">
        <h2 class="text-3xl lg:text-5xl font-bold text-black mb-6">
            Ready to move from translation to transformation?
        </h2>
        <a href="/contact"
            class="inline-block bg-[#98C441] text-black px-6 py-3 font-bold text-base lg:text-lg transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-[#98C441] focus:ring-offset-2 focus:ring-offset-[#1F3131]">
            Connect with our team
        </a>
    </div>
</section>


<style>
.sp {
    margin-bottom: 40px;
    font-family: Inter, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
}
.sp-inner {
    position: relative;
    background: linear-gradient(135deg, #0f1b1b 0%, #1F3131 50%, #132a29 100%);
    border-radius: 16px;
    padding: 18px;
    display: flex;
    gap: 16px;
    align-items: flex-start;
    border: 1px solid rgba(255,255,255,0.08);
    box-shadow: 0 10px 34px rgba(10, 20, 20, 0.36);
    transition: transform .25s ease, box-shadow .25s ease;
    overflow: hidden;
}
.sp-inner::before {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(circle at top right, rgba(152, 196, 65, 0.18), transparent 40%);
    pointer-events: none;
}
.sp-inner:hover {
    transform: translateY(-1px);
    box-shadow: 0 16px 42px rgba(10, 20, 20, 0.45);
}

.sp-cover {
    width: 84px;
    height: 84px;
    border-radius: 10px;
    background: linear-gradient(145deg, #006155 0%, #98C441 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    position: relative;
    overflow: hidden;
    box-shadow: inset 0 0 0 1px rgba(255,255,255,0.12), 0 10px 18px rgba(0,0,0,0.2);
}
.sp-cover::after {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(to bottom, rgba(255,255,255,.22), rgba(255,255,255,0));
    pointer-events: none;
}
.sp-cover-icon svg {
    width: 34px;
    height: 34px;
    color: rgba(255,255,255,0.92);
}
.sp-eq {
    position: absolute;
    bottom: 9px;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    align-items: flex-end;
    gap: 3px;
    height: 20px;
}
.sp-eq span {
    width: 3px;
    border-radius: 2px;
    background: #fff;
    animation: spEq 1.2s ease-in-out infinite;
}
.sp-eq span:nth-child(1) { height: 8px; animation-delay: 0s; }
.sp-eq span:nth-child(2) { height: 14px; animation-delay: 0.2s; }
.sp-eq span:nth-child(3) { height: 6px; animation-delay: 0.4s; }
.sp-eq span:nth-child(4) { height: 10px; animation-delay: 0.6s; }
@keyframes spEq {
    0%, 100% { height: 4px; }
    50% { height: 18px; }
}

.sp-body {
    flex: 1;
    min-width: 0;
    display: flex;
    flex-direction: column;
    gap: 10px;
    position: relative;
    z-index: 1;
}
.sp-meta {
    display: flex;
    flex-direction: column;
    gap: 2px;
}
.sp-chip {
    align-self: flex-start;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 3px 8px;
    border-radius: 999px;
    font-size: 10px;
    font-weight: 700;
    letter-spacing: .08em;
    text-transform: uppercase;
    color: #98C441;
    background: rgba(152, 196, 65, 0.15);
    border: 1px solid rgba(152, 196, 65, 0.3);
}
.sp-chip-dot {
    width: 5px;
    height: 5px;
    border-radius: 999px;
    background: #98C441;
}
.sp-track-title {
    color: #fff;
    font-size: 15px;
    font-weight: 700;
    line-height: 1.3;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
.sp-track-sub {
    color: rgba(255,255,255,0.6);
    font-size: 12px;
    font-weight: 500;
}

.sp-play-big {
    width: 42px;
    height: 42px;
    border-radius: 50%;
    background: #98C441;
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    flex-shrink: 0;
    transition: transform .15s ease, background .2s ease, box-shadow .2s ease;
    box-shadow: 0 8px 14px rgba(152, 196, 65, 0.35);
}
.sp-play-big[disabled] {
    opacity: 0.65;
    cursor: not-allowed;
    transform: none;
    box-shadow: none;
}
.sp-play-big:hover {
    transform: scale(1.05);
    background: #a9d454;
    box-shadow: 0 10px 18px rgba(152, 196, 65, 0.42);
}
.sp-play-big:active { transform: scale(0.97); }
.sp-play-big svg {
    width: 18px;
    height: 18px;
    color: #1F3131;
    margin-left: 2px;
}

.sp-init {
    display: flex;
    align-items: center;
    gap: 12px;
}
.sp-loader {
    display: flex;
    align-items: center;
    gap: 10px;
    color: rgba(255,255,255,0.7);
    font-size: 12px;
    font-weight: 600;
}
.sp-spinner {
    width: 18px;
    height: 18px;
    border: 2px solid rgba(255,255,255,0.15);
    border-top-color: #98C441;
    border-radius: 50%;
    animation: spSpin 0.75s linear infinite;
}
@keyframes spSpin { to { transform: rotate(360deg); } }

.sp-ctrl {
    display: flex;
    flex-direction: column;
    gap: 10px;
    animation: spFade .35s ease;
}
.sp-subline {
    min-height: 18px;
}
.sp-cache {
    display: inline-flex;
    align-items: center;
    padding: 2px 8px;
    border-radius: 999px;
    font-size: 11px;
    font-weight: 600;
    color: #98C441;
    background: rgba(152,196,65,.12);
    border: 1px solid rgba(152,196,65,.24);
}
@keyframes spFade {
    from { opacity: 0; transform: translateY(4px); }
    to { opacity: 1; transform: translateY(0); }
}
.sp-ctrl-top {
    display: flex;
    align-items: center;
    gap: 12px;
}
.sp-progress-area {
    flex: 1;
    display: flex;
    align-items: center;
    gap: 8px;
    min-width: 0;
}
.sp-time {
    color: rgba(255,255,255,0.65);
    font-size: 11px;
    font-variant-numeric: tabular-nums;
    min-width: 36px;
    text-align: center;
    user-select: none;
}
.sp-bar-wrap {
    flex: 1;
    position: relative;
    height: 16px;
    display: flex;
    align-items: center;
}
.sp-bar-track {
    width: 100%;
    height: 4px;
    border-radius: 2px;
    background: rgba(255,255,255,0.16);
    position: relative;
    transition: height .15s ease;
}
.sp-bar-fill {
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    width: 0%;
    background: rgba(255,255,255,0.78);
    border-radius: 2px;
    pointer-events: none;
    transition: background .2s ease;
}
.sp-bar-dot {
    position: absolute;
    top: 50%;
    left: 0%;
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: #fff;
    transform: translate(-50%, -50%);
    opacity: 0;
    transition: opacity .15s ease;
    pointer-events: none;
    box-shadow: 0 2px 8px rgba(0,0,0,0.3);
}
.sp-bar-wrap:hover .sp-bar-fill { background: #98C441; }
.sp-bar-wrap:hover .sp-bar-dot { opacity: 1; }
.sp-bar-wrap:hover .sp-bar-track { height: 6px; }
.sp-seek {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    cursor: pointer;
    margin: 0;
    z-index: 2;
    -webkit-appearance: none;
}
.sp-ctrl-btm {
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.sp-vol {
    display: flex;
    align-items: center;
    gap: 6px;
}
.sp-btn-sm {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    background: transparent;
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    flex-shrink: 0;
    transition: background .15s ease;
    padding: 0;
}
.sp-btn-sm:hover { background: rgba(255,255,255,0.12); }
.sp-btn-sm svg {
    width: 16px;
    height: 16px;
    color: rgba(255,255,255,0.75);
    transition: color .15s ease;
}
.sp-btn-sm:hover svg { color: #fff; }
.sp-vol-bar-wrap {
    position: relative;
    width: 92px;
    height: 16px;
    display: flex;
    align-items: center;
}
.sp-vol-track {
    width: 100%;
    height: 4px;
    border-radius: 2px;
    background: rgba(255,255,255,0.16);
    position: relative;
}
.sp-vol-fill {
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    border-radius: 2px;
    background: rgba(255,255,255,0.78);
    pointer-events: none;
    transition: background .2s ease;
}
.sp-vol-dot {
    position: absolute;
    top: 50%;
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: #fff;
    transform: translate(-50%, -50%);
    opacity: 0;
    pointer-events: none;
    transition: opacity .15s ease;
}
.sp-vol-bar-wrap:hover .sp-vol-fill { background: #98C441; }
.sp-vol-bar-wrap:hover .sp-vol-dot { opacity: 1; }
.sp-vol-range {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    cursor: pointer;
    margin: 0;
    z-index: 2;
    -webkit-appearance: none;
}
.sp-toast {
    position: fixed;
    bottom: 24px;
    left: 50%;
    transform: translateX(-50%);
    background: #1F3131;
    color: #fff;
    padding: 10px 20px;
    border-radius: 24px;
    font-size: 13px;
    font-weight: 600;
    z-index: 9999;
    box-shadow: 0 8px 24px rgba(0,0,0,0.35);
    animation: spFade .25s ease;
    pointer-events: none;
}
.sp-is-buffering .sp-track-sub {
    color: rgba(152, 196, 65, 0.95);
}
@media (max-width: 640px) {
    .sp-inner { padding: 12px; gap: 12px; border-radius: 14px; }
    .sp-cover { width: 60px; height: 60px; border-radius: 8px; }
    .sp-cover-icon svg { width: 24px; height: 24px; }
    .sp-track-title { font-size: 13px; }
    .sp-track-sub { font-size: 11px; }
    .sp-vol-bar-wrap { display: none; }
}
</style>

<script type="module">
const TTS_CONFIG = {
    nonce: '<?php echo esc_js(wp_create_nonce('pg_tts_nonce')); ?>',
    endpoint: '<?php echo esc_url(admin_url('admin-ajax.php')); ?>',
    action: 'pg_generate_tts',
    chunkTimeoutMs: 45000,
    chunkRetryCount: 2,
    parallelChunks: 2
};

class SP {
    constructor() {
        this.audio = null;
        this.blob = null;
        this.audioUrl = null;
        this.createdObjectUrls = [];
        this.abortController = null;
        this.progressRaf = null;
        this.isPlayToggling = false;
        this.busy = false;
        this.muted = false;
        this.prevVol = 80;
        this.playlist = [];
        this.currentChunk = 0;
        this.chunkDurations = [];
        this.totalDuration = 0;
        this.elapsedBeforeCurrent = 0;
        this.cachedChunkCount = 0;

        this.root     = document.getElementById('sp');
        this.genBtn   = document.getElementById('sp-gen');
        this.loader   = document.getElementById('sp-loader');
        this.loaderText = this.loader?.querySelector('span') || null;
        this.init     = document.getElementById('sp-init');
        this.ctrl     = document.getElementById('sp-ctrl');
        this.playBtn  = document.getElementById('sp-play');
        this.iPlay    = document.getElementById('sp-ico-play');
        this.iPause   = document.getElementById('sp-ico-pause');
        this.seek     = document.getElementById('sp-seek');
        this.fill     = document.getElementById('sp-bar-fill');
        this.dot      = document.getElementById('sp-bar-dot');
        this.curEl    = document.getElementById('sp-cur');
        this.durEl    = document.getElementById('sp-dur');
        this.eq       = document.getElementById('sp-eq');
        this.volSlider = document.getElementById('sp-vol');
        this.volFill  = document.getElementById('sp-vol-fill');
        this.volDot   = document.getElementById('sp-vol-dot');
        this.volBtn   = document.getElementById('sp-vol-btn');
        this.volIcon  = document.getElementById('sp-vol-icon');
        this.volMute  = document.getElementById('sp-vol-mute');
        this.dlBtn    = document.getElementById('sp-dl');
        this.cacheEl  = document.getElementById('sp-cache');

        if (!this.root) return;

        this.genBtn?.addEventListener('click', () => this.generate());
        this.playBtn?.addEventListener('click', () => this.togglePlay());
        this.seek?.addEventListener('input', (e) => this.seekTo(e));
        this.volSlider?.addEventListener('input', (e) => this.setVol(e));
        this.volBtn?.addEventListener('click', () => this.toggleMute());
        this.dlBtn?.addEventListener('click', () => this.download());
    }

    getPostId() {
        return this.root?.dataset.postId || '0';
    }

    setLoaderLabel(label) {
        if (this.loaderText) this.loaderText.textContent = label;
    }

    sleep(ms) {
        return new Promise((resolve) => setTimeout(resolve, ms));
    }

    isTransientError(message = '') {
        return /network|timed out|timeout|temporarily|rate limit|429|502|503|504|try again/i.test(message);
    }

    getHttpErrorMessage(status) {
        if (status === 400) return 'Bad request while generating audio.';
        if (status === 401 || status === 403) return 'Session expired. Refresh the page and try again.';
        if (status === 404) return 'Audio endpoint not found.';
        if (status === 413) return 'Request too large. Try a shorter article.';
        if (status === 429) return 'Server is rate-limiting requests. Please try again in a moment.';
        if (status >= 500) return 'Audio service is temporarily unavailable.';
        return `Audio request failed (HTTP ${status}).`;
    }

    async requestChunkOnce(chunkIndex) {
        if ('onLine' in navigator && !navigator.onLine) {
            throw new Error('No internet connection. Check your signal and try again.');
        }

        const parentSignal = this.abortController?.signal;
        const ctrl = new AbortController();
        let timedOut = false;
        const timer = setTimeout(() => { timedOut = true; ctrl.abort(); }, TTS_CONFIG.chunkTimeoutMs);

        const onParentAbort = () => ctrl.abort();
        parentSignal?.addEventListener('abort', onParentAbort, { once: true });

        const fd = new FormData();
        fd.append('action', TTS_CONFIG.action);
        fd.append('post_id', this.getPostId());
        fd.append('nonce', TTS_CONFIG.nonce);
        fd.append('chunk_index', String(chunkIndex));

        try {
            const res = await fetch(TTS_CONFIG.endpoint, {
                method: 'POST',
                body: fd,
                signal: ctrl.signal
            });

            const raw = await res.text();
            let json = null;
            if (raw && raw.trim()) {
                try { json = JSON.parse(raw); } catch (_) { /* not json */ }
            }

            if (!res.ok) {
                throw new Error(json?.data?.message || json?.message || this.getHttpErrorMessage(res.status));
            }

            if (!json) {
                throw new Error(
                    raw.trim() === '-1' || raw.trim() === '0'
                        ? 'Session expired. Refresh the page and try again.'
                        : 'Server returned an invalid response.'
                );
            }

            if (!json.success || !json.data) {
                throw new Error(json.data?.message || 'Audio generation failed.');
            }

            return json.data;
        } catch (err) {
            if (err?.name === 'AbortError') {
                if (parentSignal?.aborted) throw err;
                if (timedOut) throw new Error('Request timed out — your connection may be slow.');
                throw new Error('Audio request was interrupted.');
            }
            throw err;
        } finally {
            clearTimeout(timer);
            parentSignal?.removeEventListener('abort', onParentAbort);
        }
    }

    async requestChunk(chunkIndex, totalHint = 0) {
        let lastError = null;
        const maxAttempts = 1 + TTS_CONFIG.chunkRetryCount;
        const label = totalHint > 1 ? `${chunkIndex + 1}/${totalHint}` : '';

        for (let attempt = 1; attempt <= maxAttempts; attempt++) {
            try {
                if (attempt > 1) {
                    this.setLoaderLabel(
                        label
                            ? `Retrying segment ${label} (attempt ${attempt}/${maxAttempts})...`
                            : `Retrying (attempt ${attempt}/${maxAttempts})...`
                    );
                    await this.sleep(800 * attempt);
                }
                return await this.requestChunkOnce(chunkIndex);
            } catch (err) {
                if (err?.name === 'AbortError') throw err;
                lastError = err;
                if (!this.isTransientError(err?.message || '') || attempt >= maxAttempts) break;
            }
        }

        const base = lastError?.message || 'Audio generation failed.';
        const suffix = maxAttempts > 1 ? ` (tried ${maxAttempts} times)` : '';
        throw new Error(label ? `Segment ${label} failed${suffix}: ${base}` : `${base}${suffix}`);
    }

    extractSource(data) {
        if (data.url) return { type: 'url', src: data.url };
        if (data.audio) return { type: 'base64', src: data.audio, mime: data.mime_type || 'audio/mpeg' };
        throw new Error('Unexpected server response.');
    }

    async refreshNonce() {
        try {
            const body = new FormData();
            body.append('action', 'pg_refresh_nonce');
            const res = await fetch(TTS_CONFIG.endpoint, { method: 'POST', body });
            if (!res.ok) return;
            const json = await res.json();
            if (json?.success && json?.data?.nonce) {
                TTS_CONFIG.nonce = json.data.nonce;
            }
        } catch (_) { /* keep existing nonce */ }
    }

    async generate() {
        if (this.busy) return;

        this.abortController?.abort();
        this.abortController = new AbortController();
        this.busy = true;
        if (this.genBtn) this.genBtn.disabled = true;
        this.genBtn.style.display = 'none';
        this.loader.style.display = 'flex';
        this.setLoaderLabel('Preparing...');
        if (this.cacheEl) this.cacheEl.style.display = 'none';

        try {
            await this.refreshNonce();
            const first = await this.requestChunk(0);
            const totalChunks = first.total || 1;
            const sources = [this.extractSource(first)];
            this.cachedChunkCount = first.cached ? 1 : 0;

            if (totalChunks > 1) {
                const remaining = Array.from({ length: totalChunks - 1 }, (_, i) => i + 1);
                const parallel = TTS_CONFIG.parallelChunks;
                let completed = 1;

                for (let i = 0; i < remaining.length; i += parallel) {
                    const batch = remaining.slice(i, i + parallel);
                    this.setLoaderLabel(
                        `Generating ${completed + 1}${batch.length > 1 ? '-' + (completed + batch.length) : ''}/${totalChunks}...`
                    );
                    const results = await Promise.all(
                        batch.map((idx) => this.requestChunk(idx, totalChunks))
                    );
                    for (const data of results) {
                        sources.push(this.extractSource(data));
                        if (data.cached) this.cachedChunkCount++;
                        completed++;
                    }
                }
            }

            this.initPlaylist(sources);
            await this.preloadDurations();
            this.showCacheState();
            this.setupMediaSession();
        } catch (err) {
            if (err?.name === 'AbortError') return;
            console.error('TTS error:', err);
            this.toast(err?.message || 'Failed to generate audio.');
            this.resetInit();
        } finally {
            this.busy = false;
            this.abortController = null;
            if (this.genBtn) this.genBtn.disabled = false;
            this.setLoaderLabel('Generating...');
        }
    }

    cleanupAudio() {
        if (this.audio) {
            this.audio.pause();
            this.audio.src = '';
            this.audio = null;
        }
        this.createdObjectUrls.forEach((url) => URL.revokeObjectURL(url));
        this.createdObjectUrls = [];
    }

    initPlaylist(sources) {
        this.cleanupAudio();

        this.playlist = [];
        this.chunkDurations = new Array(sources.length).fill(0);
        this.totalDuration = 0;
        this.currentChunk = 0;
        this.elapsedBeforeCurrent = 0;
        this.blob = null;

        for (const src of sources) {
            if (src.type === 'base64') {
                const bin = atob(src.src);
                const bytes = new Uint8Array(bin.length);
                for (let j = 0; j < bin.length; j++) bytes[j] = bin.charCodeAt(j);
                const blob = new Blob([bytes], { type: src.mime });
                const url = URL.createObjectURL(blob);
                this.createdObjectUrls.push(url);
                this.playlist.push({ src: url, blob });
            } else {
                this.playlist.push({ src: src.src, blob: null });
            }
        }

        this.attachCurrentAudio(true);
        this.init.style.display = 'none';
        this.ctrl.style.display = 'flex';
    }

    async preloadDurations() {
        const promises = this.playlist.map((item, i) =>
            new Promise((resolve) => {
                if (this.chunkDurations[i] > 0) { resolve(); return; }
                const a = new Audio(item.src);
                a.preload = 'metadata';
                const done = () => {
                    this.chunkDurations[i] = Number.isFinite(a.duration) ? a.duration : 0;
                    a.src = '';
                    resolve();
                };
                a.addEventListener('loadedmetadata', done, { once: true });
                a.addEventListener('error', done, { once: true });
                setTimeout(done, 6000);
            })
        );
        await Promise.all(promises);
        this.totalDuration = this.chunkDurations.reduce((s, d) => s + d, 0);
        this.updateDurationLabel();
    }

    attachCurrentAudio(autoPlay = false) {
        if (!this.playlist[this.currentChunk]) return;

        if (this.audio) {
            this.audio.pause();
            this.audio.src = '';
        }

        this.audioUrl = this.playlist[this.currentChunk].src;
        this.blob = this.playlist[this.currentChunk].blob;
        this.audio = new Audio(this.audioUrl);
        this.audio.preload = 'auto';
        this.audio.volume = (this.volSlider?.value || 80) / 100;

        this.audio.addEventListener('loadedmetadata', () => {
            const dur = Number.isFinite(this.audio.duration) ? this.audio.duration : 0;
            this.chunkDurations[this.currentChunk] = dur;
            this.totalDuration = this.chunkDurations.reduce((sum, n) => sum + (Number.isFinite(n) ? n : 0), 0);
            this.updateDurationLabel();
        });
        this.audio.addEventListener('timeupdate', () => this.onTime());
        this.audio.addEventListener('ended', () => this.onEnd());
        this.audio.addEventListener('playing', () => {
            this.showPlaying(true);
            this.setBuffering(false);
            this.startProgressLoop();
            this.isPlayToggling = false;
        });
        this.audio.addEventListener('pause', () => {
            if (!this.audio?.ended) this.showPlaying(false);
            this.stopProgressLoop();
            this.isPlayToggling = false;
        });
        this.audio.addEventListener('waiting', () => this.setBuffering(true));
        this.audio.addEventListener('canplay', () => this.setBuffering(false));
        this.audio.addEventListener('seeked', () => this.setBuffering(false));
        this.audio.addEventListener('error', () => {
            this.toast('Playback error. Please tap play to retry.');
            this.showPlaying(false);
            this.setBuffering(false);
            this.isPlayToggling = false;
        });

        if (autoPlay) {
            this.audio.play()
                .then(() => {
                    this.showPlaying(true);
                    this.startProgressLoop();
                })
                .catch(() => {
                    this.showPlaying(false);
                    this.isPlayToggling = false;
                });
        } else {
            this.showPlaying(false);
        }
    }

    togglePlay() {
        if (!this.audio || this.isPlayToggling) return;
        this.isPlayToggling = true;
        if (this.audio.paused) {
            this.setBuffering(true);
            this.audio.play()
                .then(() => this.showPlaying(true))
                .catch(() => {
                    this.toast('Unable to start playback. Tap play again.');
                    this.isPlayToggling = false;
                    this.setBuffering(false);
                });
        }
        else {
            this.audio.pause();
            this.showPlaying(false);
            this.isPlayToggling = false;
        }
    }

    showPlaying(p) {
        this.iPlay.style.display = p ? 'none' : 'block';
        this.iPause.style.display = p ? 'block' : 'none';
        this.eq.style.display = p ? 'flex' : 'none';
        if ('mediaSession' in navigator) {
            navigator.mediaSession.playbackState = p ? 'playing' : 'paused';
        }
    }

    onTime() {
        if (!this.audio) return;

        const effectiveDuration = this.totalDuration > 0 ? this.totalDuration : this.audio.duration;
        if (!effectiveDuration || Number.isNaN(effectiveDuration)) return;

        const absoluteCurrent = this.elapsedBeforeCurrent + this.audio.currentTime;
        const pct = (absoluteCurrent / effectiveDuration) * 100;
        this.fill.style.width = pct + '%';
        this.dot.style.left = pct + '%';
        this.seek.value = pct * 10;
        this.curEl.textContent = this.fmt(absoluteCurrent);
        this.updateDurationLabel();

        if ('mediaSession' in navigator && 'setPositionState' in navigator.mediaSession && effectiveDuration > 0) {
            try {
                navigator.mediaSession.setPositionState({
                    duration: effectiveDuration,
                    position: Math.min(absoluteCurrent, effectiveDuration),
                    playbackRate: this.audio.playbackRate || 1,
                });
            } catch (_) { /* some browsers reject invalid states */ }
        }
    }

    seekTo(e) {
        if (!this.audio || this.totalDuration <= 0) return;
        this.setBuffering(true);
        const absoluteTime = (e.target.value / 1000) * this.totalDuration;
        this.seekToAbsolute(absoluteTime);
    }

    seekToAbsolute(absoluteTime) {
        if (this.totalDuration <= 0) return;
        const clamped = Math.max(0, Math.min(absoluteTime, this.totalDuration));

        let accumulated = 0;
        let targetChunk = 0;
        let offsetInChunk = 0;

        for (let i = 0; i < this.chunkDurations.length; i++) {
            const dur = this.chunkDurations[i] || 0;
            if (accumulated + dur > clamped || i === this.chunkDurations.length - 1) {
                targetChunk = i;
                offsetInChunk = clamped - accumulated;
                break;
            }
            accumulated += dur;
        }

        this.elapsedBeforeCurrent = accumulated;

        if (targetChunk !== this.currentChunk) {
            this.currentChunk = targetChunk;
            const wasPlaying = this.audio && !this.audio.paused;
            this.attachCurrentAudio(false);

            const doSeek = () => {
                if (this.audio) {
                    this.audio.currentTime = Math.min(Math.max(0, offsetInChunk), this.audio.duration || 0);
                    if (wasPlaying) this.audio.play().catch(() => {});
                }
                this.setBuffering(false);
                this.onTime();
            };

            if (this.audio?.readyState >= 1) {
                doSeek();
            } else {
                this.audio?.addEventListener('loadedmetadata', doSeek, { once: true });
            }
        } else if (this.audio) {
            this.audio.currentTime = Math.min(Math.max(0, offsetInChunk), this.audio.duration || 0);
            this.setBuffering(false);
            this.onTime();
        }
    }

    onEnd() {
        const dur = this.chunkDurations[this.currentChunk]
            || (Number.isFinite(this.audio?.duration) ? this.audio.duration : 0);
        this.elapsedBeforeCurrent += dur;

        if (this.currentChunk < this.playlist.length - 1) {
            this.currentChunk += 1;
            this.attachCurrentAudio(true);
            return;
        }

        this.showPlaying(false);
        this.stopProgressLoop();
        this.currentChunk = 0;
        this.elapsedBeforeCurrent = 0;
        this.attachCurrentAudio(false);
        this.seek.value = 0;
        this.fill.style.width = '0%';
        this.dot.style.left = '0%';
        this.curEl.textContent = '0:00';
        this.updateDurationLabel();
    }

    setVol(e) {
        const v = +e.target.value;
        if (this.audio) this.audio.volume = v / 100;
        this.volFill.style.width = v + '%';
        this.volDot.style.left = v + '%';
        this.muted = v === 0;
        this.volIcon.style.display = this.muted ? 'none' : 'block';
        this.volMute.style.display = this.muted ? 'block' : 'none';
        if (v > 0) this.prevVol = v;
    }

    toggleMute() {
        if (this.muted) {
            this.volSlider.value = this.prevVol;
        } else {
            this.prevVol = +this.volSlider.value || 80;
            this.volSlider.value = 0;
        }
        this.setVol({ target: this.volSlider });
    }

    async download() {
        if (this.playlist.length === 0) return;

        if (this.playlist.length === 1) {
            const a = document.createElement('a');
            if (this.playlist[0].blob) {
                a.href = URL.createObjectURL(this.playlist[0].blob);
                a.download = `article-audio-${Date.now()}.mp3`;
                a.click();
                URL.revokeObjectURL(a.href);
            } else {
                a.href = this.playlist[0].src;
                a.download = `article-audio-${Date.now()}.mp3`;
                a.target = '_blank';
                a.rel = 'noopener noreferrer';
                a.click();
            }
            return;
        }

        this.toast('Preparing full audio download...');
        try {
            const parts = [];
            for (const item of this.playlist) {
                if (item.blob) {
                    parts.push(item.blob);
                } else {
                    const res = await fetch(item.src);
                    parts.push(await res.blob());
                }
            }
            const merged = new Blob(parts, { type: 'audio/mpeg' });
            const url = URL.createObjectURL(merged);
            const a = document.createElement('a');
            a.href = url;
            a.download = `article-audio-${Date.now()}.mp3`;
            a.click();
            setTimeout(() => URL.revokeObjectURL(url), 60000);
        } catch (err) {
            this.toast('Download failed. Please try again.');
        }
    }

    startProgressLoop() {
        this.stopProgressLoop();
        const tick = () => {
            this.onTime();
            if (this.audio && !this.audio.paused && !this.audio.ended) {
                this.progressRaf = requestAnimationFrame(tick);
            }
        };
        this.progressRaf = requestAnimationFrame(tick);
    }

    stopProgressLoop() {
        if (this.progressRaf) {
            cancelAnimationFrame(this.progressRaf);
            this.progressRaf = null;
        }
    }

    setBuffering(isBuffering) {
        if (!this.root) return;
        this.root.classList.toggle('sp-is-buffering', Boolean(isBuffering));
    }

    resetInit() {
        this.genBtn.style.display = 'inline-flex';
        this.loader.style.display = 'none';
    }

    showCacheState() {
        if (!this.cacheEl) return;
        this.cacheEl.style.display = 'inline-flex';
        const total = this.playlist.length;
        if (this.cachedChunkCount === total) {
            this.cacheEl.textContent = 'Instant playback (cached)';
        } else if (total > 1) {
            this.cacheEl.textContent = `${total} segments ready`;
        } else {
            this.cacheEl.textContent = 'Fresh audio generated';
        }
    }

    setupMediaSession() {
        if (!('mediaSession' in navigator)) return;
        const title = this.root?.querySelector('.sp-track-title')?.textContent || 'Article Audio';
        try {
            navigator.mediaSession.metadata = new MediaMetadata({
                title,
                artist: 'Piedmont Global',
            });
        } catch (_) { /* older browsers */ }

        navigator.mediaSession.setActionHandler('play', () => {
            if (this.audio?.paused) this.togglePlay();
        });
        navigator.mediaSession.setActionHandler('pause', () => {
            if (this.audio && !this.audio.paused) this.togglePlay();
        });
        navigator.mediaSession.setActionHandler('stop', () => {
            if (this.audio) { this.audio.pause(); this.showPlaying(false); }
        });
        try {
            navigator.mediaSession.setActionHandler('seekto', (details) => {
                if (details.seekTime != null) this.seekToAbsolute(details.seekTime);
            });
        } catch (_) { /* not supported everywhere */ }
    }

    toast(msg) {
        document.querySelectorAll('.sp-toast').forEach((t) => t.remove());
        const el = document.createElement('div');
        el.className = 'sp-toast';
        el.textContent = msg;
        el.style.cursor = 'pointer';
        el.addEventListener('click', () => el.remove());
        document.body.appendChild(el);
        const duration = Math.max(3000, Math.min(msg.length * 60, 8000));
        setTimeout(() => el.remove(), duration);
    }

    fmt(s) {
        if (!s || isNaN(s)) return '0:00';
        return Math.floor(s / 60) + ':' + String(Math.floor(s % 60)).padStart(2, '0');
    }

    updateDurationLabel() {
        const dur = this.totalDuration > 0
            ? this.totalDuration
            : (this.audio?.duration && Number.isFinite(this.audio.duration) ? this.audio.duration : 0);
        this.durEl.textContent = this.fmt(dur);
    }
}

document.readyState === 'loading'
    ? document.addEventListener('DOMContentLoaded', () => new SP())
    : new SP();
</script>

<?php
get_footer();
?>
