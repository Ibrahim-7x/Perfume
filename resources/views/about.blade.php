<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8"/>
<title>TROY Perfumes – About Us</title>
<script>window.BASE_URL = '{{ rtrim(url("/"), "/") }}';</script>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<script>document.documentElement.setAttribute('data-theme', localStorage.getItem('troy-theme') || 'light');</script>
<link href="https://fonts.googleapis.com" rel="preconnect"/>
<link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;0,900;1,300;1,400&display=swap" rel="stylesheet"/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet"/>
<style>
:root{
  --bg:#050816;
  --bg-soft:#050b1f;
  --bg-elevated:#070f25;
  --primary:#22c55e;
  --primary-soft:rgba(34,197,94,0.14);
  --primary-strong:#16a34a;
  --accent:#38bdf8;
  --accent-soft:rgba(56,189,248,0.12);
  --card:#050b18;
  --glass:rgba(15,23,42,0.65);
  --text-main:#e5f2ff;
  --text-muted:#9ca3af;
  --border-subtle:rgba(148,163,184,0.2);
  --card-radius:26px;
  --shadow-soft:0 18px 45px rgba(15,23,42,0.75);
}
*{box-sizing:border-box;margin:0;padding:0}
html{scroll-behavior:smooth;}
body{
  font-family:'Poppins',system-ui,sans-serif;
  background:radial-gradient(circle at top,#172554 0,#020617 55%,#000 100%);
  color:var(--text-main);
  min-height:100vh;
  overflow-x:hidden;
}

/* PARTICLES */
.particles{position:fixed;inset:0;pointer-events:none;z-index:0;overflow:hidden;}
.particle{
  position:absolute;
  width:3px;height:3px;
  background:rgba(56,189,248,0.6);
  border-radius:50%;
  animation:floatUp var(--dur,8s) linear var(--delay,0s) infinite;
  left:var(--left,50%);
  bottom:-10px;
}
@keyframes floatUp{
  0%{transform:translateY(0) scale(1);opacity:0.8;}
  100%{transform:translateY(-110vh) scale(0);opacity:0;}
}

/* PAGE WRAPPER */
.page{position:relative;z-index:1;}

/* ── HERO ── */
.about-hero{
  min-height:92vh;
  display:flex;flex-direction:column;align-items:center;justify-content:center;
  text-align:center;padding:5rem 2rem 3rem;
  position:relative;
}
.about-hero::before{
  content:'';
  position:absolute;inset:0;
  background:
    radial-gradient(ellipse 70% 60% at 50% 20%, rgba(34,197,94,0.07) 0%, transparent 70%),
    radial-gradient(ellipse 50% 40% at 80% 80%, rgba(56,189,248,0.06) 0%, transparent 60%);
  pointer-events:none;
}
.hero-eyebrow{
  display:inline-flex;align-items:center;gap:.6rem;
  padding:.35rem 1rem;border-radius:999px;
  border:1px solid rgba(34,197,94,0.5);
  background:rgba(34,197,94,0.08);
  color:var(--primary);font-size:.78rem;
  letter-spacing:.15em;text-transform:uppercase;
  margin-bottom:2rem;
  animation:fadeDown .8s ease-out both;
}
.hero-title{
  font-size:clamp(3rem,8vw,7rem);
  font-weight:900;line-height:1;
  letter-spacing:.04em;
  margin-bottom:1.5rem;
  animation:fadeDown .9s .1s ease-out both;
}
.hero-title .line1{
  display:block;
  background:linear-gradient(120deg,#e5e7eb,#a5f3fc,#bbf7d0);
  -webkit-background-clip:text;-webkit-text-fill-color:transparent;
}
.hero-title .line2{
  display:block;
  background:linear-gradient(120deg,#bbf7d0,#38bdf8,#e5e7eb);
  -webkit-background-clip:text;-webkit-text-fill-color:transparent;
}
.hero-desc{
  max-width:600px;margin:0 auto 3rem;
  color:var(--text-muted);font-size:1.1rem;line-height:1.8;
  animation:fadeDown 1s .2s ease-out both;
}
.hero-stats{
  display:flex;gap:3rem;justify-content:center;flex-wrap:wrap;
  animation:fadeDown 1s .3s ease-out both;
}
.stat-item{text-align:center;}
.stat-num{
  font-size:2.4rem;font-weight:900;line-height:1;
  background:linear-gradient(135deg,var(--primary),var(--accent));
  -webkit-background-clip:text;-webkit-text-fill-color:transparent;
}
.stat-label{font-size:.75rem;color:var(--text-muted);letter-spacing:.1em;text-transform:uppercase;margin-top:.3rem;}
.scroll-hint{
  position:absolute;bottom:2.5rem;left:50%;transform:translateX(-50%);
  display:flex;flex-direction:column;align-items:center;gap:.5rem;
  color:var(--text-muted);font-size:.75rem;letter-spacing:.1em;
  animation:bobUpDown 2s ease-in-out infinite;
}
.scroll-hint i{font-size:1.2rem;color:var(--primary);}
@keyframes bobUpDown{0%,100%{transform:translateX(-50%) translateY(0);}50%{transform:translateX(-50%) translateY(6px);}}
@keyframes fadeDown{from{opacity:0;transform:translateY(-20px);}to{opacity:1;transform:translateY(0);}}

/* ── SECTION SHARED ── */
section{padding:6rem 4.5rem;}
.section-label{
  display:inline-flex;align-items:center;gap:.5rem;
  font-size:.72rem;letter-spacing:.18em;text-transform:uppercase;
  color:var(--primary);margin-bottom:1.2rem;
}
.section-label::before{
  content:'';width:24px;height:2px;
  background:linear-gradient(90deg,var(--primary),var(--accent));
  border-radius:999px;
}
.section-title{
  font-size:clamp(2rem,4vw,3.2rem);font-weight:800;
  line-height:1.15;letter-spacing:.02em;margin-bottom:1rem;
}
.section-sub{color:var(--text-muted);line-height:1.8;max-width:560px;}

/* ── STORY ── */
.story-section{position:relative;}
.story-grid{
  display:grid;grid-template-columns:1fr 1fr;gap:5rem;align-items:center;
  margin-top:4rem;
}
.story-visual{
  position:relative;
}
.story-main-card{
  background:linear-gradient(135deg,rgba(34,197,94,0.06),rgba(56,189,248,0.04));
  border:1px solid rgba(34,197,94,0.2);
  border-radius:var(--card-radius);
  padding:3rem;
  position:relative;overflow:hidden;
}
.story-main-card::before{
  content:'';
  position:absolute;top:-80px;right:-80px;
  width:200px;height:200px;
  background:radial-gradient(circle,rgba(34,197,94,0.15),transparent 70%);
  pointer-events:none;
}
.story-year{
  font-size:7rem;font-weight:900;line-height:1;
  background:linear-gradient(135deg,rgba(34,197,94,0.25),rgba(56,189,248,0.15));
  -webkit-background-clip:text;-webkit-text-fill-color:transparent;
  margin-bottom:.5rem;
}
.story-founded{font-size:.8rem;color:var(--text-muted);letter-spacing:.15em;text-transform:uppercase;}
.story-quote{
  font-size:1.3rem;font-style:italic;font-weight:300;
  color:var(--text-main);line-height:1.7;margin-top:1.5rem;
  border-left:3px solid var(--primary);
  padding-left:1.2rem;
}
.story-float-badge{
  position:absolute;bottom:-1.5rem;right:2rem;
  background:var(--bg-elevated);
  border:1px solid rgba(56,189,248,0.4);
  border-radius:16px;padding:.9rem 1.4rem;
  display:flex;align-items:center;gap:.8rem;
  box-shadow:0 10px 30px rgba(0,0,0,0.5);
}
.story-float-badge i{color:var(--accent);font-size:1.3rem;}
.story-float-badge strong{font-size:.85rem;display:block;}
.story-float-badge span{font-size:.7rem;color:var(--text-muted);}

.story-text p{color:var(--text-muted);line-height:1.85;margin-bottom:1.2rem;font-size:.95rem;}
.story-text p:first-child{font-size:1.05rem;color:var(--text-main);font-weight:400;}

/* ── SCENT PHILOSOPHY ── */
.philosophy-section{
  background:linear-gradient(135deg,rgba(34,197,94,0.03),rgba(56,189,248,0.02));
  border-top:1px solid var(--border-subtle);
  border-bottom:1px solid var(--border-subtle);
}
.philosophy-grid{
  display:grid;grid-template-columns:repeat(3,1fr);gap:2rem;margin-top:4rem;
}
.phil-card{
  border:1px solid var(--border-subtle);
  border-radius:var(--card-radius);
  padding:2.5rem;
  background:rgba(5,8,22,0.6);
  backdrop-filter:blur(10px);
  position:relative;overflow:hidden;
  transition:transform .3s,border-color .3s,box-shadow .3s;
  cursor:default;
}
.phil-card::after{
  content:'';
  position:absolute;inset:0;
  background:radial-gradient(circle at 50% 0%,var(--glow,rgba(34,197,94,0.07)),transparent 70%);
  opacity:0;transition:.4s;
}
.phil-card:hover{transform:translateY(-6px);border-color:var(--border-color,rgba(34,197,94,0.4));box-shadow:0 20px 50px rgba(0,0,0,0.5);}
.phil-card:hover::after{opacity:1;}
.phil-icon{
  width:60px;height:60px;border-radius:18px;
  display:flex;align-items:center;justify-content:center;
  font-size:1.5rem;margin-bottom:1.5rem;
  background:var(--icon-bg,rgba(34,197,94,0.1));
  border:1px solid var(--icon-border,rgba(34,197,94,0.3));
  color:var(--icon-color,var(--primary));
}
.phil-title{font-size:1.15rem;font-weight:700;margin-bottom:.7rem;}
.phil-desc{font-size:.87rem;color:var(--text-muted);line-height:1.75;}

/* ── TEAM ── */
.team-section{}
.team-header{display:flex;align-items:flex-end;justify-content:space-between;flex-wrap:wrap;gap:1rem;margin-bottom:4rem;}
.team-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:1.8rem;}
.team-card{
  border-radius:var(--card-radius);overflow:hidden;
  border:1px solid var(--border-subtle);
  background:rgba(5,11,24,0.8);
  transition:transform .3s,border-color .3s;
}
.team-card:hover{transform:translateY(-5px);border-color:rgba(34,197,94,0.35);}
.team-avatar{
  height:220px;position:relative;
  display:flex;align-items:center;justify-content:center;
  background:var(--av-bg);
  overflow:hidden;
}
.team-avatar svg{position:relative;z-index:1;}
.team-avatar::after{
  content:'';position:absolute;bottom:0;left:0;right:0;height:50%;
  background:linear-gradient(to top,var(--bg-soft),transparent);
}
.team-info{padding:1.5rem;}
.team-name{font-size:1rem;font-weight:700;margin-bottom:.25rem;}
.team-role{font-size:.78rem;color:var(--primary);letter-spacing:.08em;text-transform:uppercase;margin-bottom:.6rem;}
.team-bio{font-size:.82rem;color:var(--text-muted);line-height:1.6;}
.team-socials{display:flex;gap:.5rem;margin-top:1rem;}
.social-btn{
  width:30px;height:30px;border-radius:8px;
  border:1px solid var(--border-subtle);
  background:transparent;color:var(--text-muted);font-size:.8rem;
  display:flex;align-items:center;justify-content:center;
  cursor:pointer;transition:.2s;
}
.social-btn:hover{border-color:var(--accent);color:var(--accent);}

/* ── MILESTONES ── */
.timeline-section{position:relative;}
.timeline-section::before{
  content:'';
  position:absolute;left:50%;top:10rem;bottom:3rem;width:2px;
  background:linear-gradient(to bottom,transparent,rgba(34,197,94,0.4),rgba(56,189,248,0.4),transparent);
  transform:translateX(-50%);
}
.timeline-header{text-align:center;margin-bottom:5rem;}
.timeline{display:flex;flex-direction:column;gap:0;}
.timeline-item{
  display:grid;grid-template-columns:1fr 80px 1fr;
  align-items:start;gap:0;
  margin-bottom:3rem;
}
.timeline-item:nth-child(even) .tl-content{grid-column:3;}
.timeline-item:nth-child(odd) .tl-content{grid-column:1;text-align:right;}
.timeline-item:nth-child(even) .tl-dot-col{grid-column:2;grid-row:1;}
.timeline-item:nth-child(odd) .tl-dot-col{grid-column:2;grid-row:1;}
.timeline-item:nth-child(even) .tl-empty{grid-column:1;grid-row:1;}
.timeline-item:nth-child(odd) .tl-empty{grid-column:3;grid-row:1;}

.tl-dot-col{display:flex;justify-content:center;padding-top:.8rem;}
.tl-dot{
  width:44px;height:44px;border-radius:50%;
  background:var(--bg-elevated);
  border:2px solid var(--primary);
  display:flex;align-items:center;justify-content:center;
  color:var(--primary);font-size:.9rem;
  box-shadow:0 0 20px rgba(34,197,94,0.3);
  flex-shrink:0;
}
.tl-content{
  background:rgba(5,11,24,0.7);
  border:1px solid var(--border-subtle);
  border-radius:20px;padding:1.5rem;
  backdrop-filter:blur(10px);
  transition:.3s;
}
.tl-content:hover{border-color:rgba(34,197,94,0.3);}
.tl-year{font-size:.7rem;letter-spacing:.18em;color:var(--primary);text-transform:uppercase;margin-bottom:.4rem;}
.tl-title{font-size:1rem;font-weight:700;margin-bottom:.4rem;}
.tl-desc{font-size:.83rem;color:var(--text-muted);line-height:1.6;}

/* ── VALUES ── */
.values-section{
  background:radial-gradient(ellipse 80% 50% at 50% 50%,rgba(56,189,248,0.04),transparent);
  border-top:1px solid var(--border-subtle);
}
.values-header{text-align:center;margin-bottom:4rem;}
.values-header .section-label{justify-content:center;}
.values-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:1.5rem;}
.value-card{
  display:flex;gap:1.5rem;align-items:flex-start;
  border:1px solid var(--border-subtle);border-radius:20px;
  padding:2rem;background:rgba(5,8,22,0.6);
  transition:.3s;
}
.value-card:hover{border-color:rgba(56,189,248,0.3);transform:translateX(4px);}
.value-num{
  font-size:2.5rem;font-weight:900;line-height:1;
  background:linear-gradient(135deg,rgba(34,197,94,0.3),rgba(56,189,248,0.2));
  -webkit-background-clip:text;-webkit-text-fill-color:transparent;
  flex-shrink:0;width:50px;
}
.value-body{}
.value-title{font-size:1rem;font-weight:700;margin-bottom:.5rem;}
.value-text{font-size:.85rem;color:var(--text-muted);line-height:1.7;}

/* ── CTA ── */
.cta-section{
  text-align:center;padding:8rem 4.5rem;
  position:relative;overflow:hidden;
}
.cta-section::before{
  content:'';position:absolute;inset:0;
  background:
    radial-gradient(ellipse 60% 60% at 50% 50%,rgba(34,197,94,0.08),transparent 70%);
  pointer-events:none;
}
.cta-title{
  font-size:clamp(2.5rem,5vw,4.5rem);font-weight:900;
  line-height:1.1;margin-bottom:1.5rem;
  background:linear-gradient(120deg,#e5e7eb,#a5f3fc,#bbf7d0);
  -webkit-background-clip:text;-webkit-text-fill-color:transparent;
}
.cta-sub{color:var(--text-muted);font-size:1.05rem;line-height:1.8;max-width:500px;margin:0 auto 3rem;}
.cta-btns{display:flex;gap:1rem;justify-content:center;flex-wrap:wrap;}
.btn-ghost{
  padding:.75rem 1.6rem;border-radius:999px;
  border:1px solid rgba(148,163,184,0.4);
  background:rgba(15,23,42,0.7);color:var(--text-main);
  font-size:.9rem;font-family:'Poppins',sans-serif;
  cursor:pointer;transition:.3s;
  display:inline-flex;align-items:center;gap:.5rem;
}
.btn-ghost:hover{border-color:var(--accent);}

/* ── FOOTER ── */
.footer{
    background:#020617;
    border-top:1px solid rgba(148,163,184,0.15);
    padding:3.5rem 4.5rem 2rem;
}
.footer-content{
    display:grid;
    grid-template-columns:2.2fr 1.2fr 1.2fr 1.6fr;
    gap:2.4rem;
    margin-bottom:2rem;
}
.footer-logo{
    width:60px;
    height:60px;
    margin-bottom:.9rem;
}
.footer-column h3{
    margin-bottom:.8rem;
    font-weight:600;
}
.footer-links{
    list-style:none;
    display:flex;
    flex-direction:column;
    gap:.5rem;
    font-size:.9rem;
}
.footer-links a{
    color:var(--text-muted);
    text-decoration:none;
    transition:color 0.3s ease, transform 0.3s ease;
    display:inline-block;
}
.footer-links a:hover{
    color:var(--primary);
    transform:translateX(3px);
}
.social-links{
    display:flex;
    gap:.6rem;
}
.social-link{
    width:34px;
    height:34px;
    border-radius:999px;
    border:1px solid rgba(148,163,184,0.4);
    display:flex;
    align-items:center;
    justify-content:center;
    color:var(--text-muted);
    text-decoration:none;
    font-size:.85rem;
    transition:all 0.3s ease;
}
.social-link:hover{
    border-color:var(--primary);
    color:var(--primary);
    transform:translateY(-2px);
}
.footer-bottom{
    border-top:1px solid rgba(15,23,42,0.85);
    padding-top:1rem;
    font-size:.8rem;
    color:var(--text-muted);
    text-align:center;
}

/* ── CORPORATE ── */
.corporate-section{padding:6rem 4.5rem;border-top:1px solid var(--border-subtle);position:relative;}
.corporate-header{display:flex;align-items:flex-start;justify-content:space-between;flex-wrap:wrap;gap:2rem;margin-bottom:4rem;}
.corp-stats-row{display:flex;gap:1.5rem;flex-wrap:wrap;align-items:center;}
.corp-stat{text-align:center;background:rgba(5,11,24,0.7);border:1px solid var(--border-subtle);border-radius:18px;padding:1.2rem 1.8rem;min-width:110px;}
.corp-stat-num{display:block;font-size:2rem;font-weight:900;line-height:1;background:linear-gradient(135deg,var(--primary),var(--accent));-webkit-background-clip:text;-webkit-text-fill-color:transparent;}
.corp-stat-label{display:block;font-size:.7rem;color:var(--text-muted);letter-spacing:.1em;text-transform:uppercase;margin-top:.3rem;}
.corp-categories{display:grid;grid-template-columns:repeat(4,1fr);gap:1.5rem;margin-bottom:3rem;}
.corp-cat-card{border:1px solid var(--border-subtle);border-radius:var(--card-radius);padding:2rem 1.8rem;background:rgba(5,8,22,0.7);backdrop-filter:blur(10px);display:flex;flex-direction:column;transition:transform .3s,border-color .3s,box-shadow .3s;position:relative;overflow:hidden;}
.corp-cat-card::before{content:'';position:absolute;inset:0;background:radial-gradient(circle at 50% 0%,var(--ci-bg,rgba(34,197,94,0.07)),transparent 65%);opacity:0;transition:.4s;}
.corp-cat-card:hover{transform:translateY(-5px);border-color:var(--ci-border,rgba(34,197,94,0.4));box-shadow:0 20px 50px rgba(0,0,0,0.45);}
.corp-cat-card:hover::before{opacity:1;}
.corp-cat-icon{width:52px;height:52px;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:1.3rem;margin-bottom:1.2rem;background:var(--ci-bg,rgba(34,197,94,0.1));border:1px solid var(--ci-border,rgba(34,197,94,0.3));color:var(--ci-color,var(--primary));position:relative;z-index:1;}
.corp-cat-title{font-size:1rem;font-weight:700;margin-bottom:.6rem;position:relative;z-index:1;}
.corp-cat-desc{font-size:.83rem;color:var(--text-muted);line-height:1.72;margin-bottom:1.4rem;flex:1;position:relative;z-index:1;}
.corp-cat-clients{display:flex;flex-direction:column;gap:.5rem;position:relative;z-index:1;}
.corp-client-chip{display:flex;align-items:center;gap:.5rem;font-size:.78rem;color:var(--text-muted);padding:.45rem .85rem;border-radius:8px;background:rgba(255,255,255,0.03);border:1px solid rgba(148,163,184,0.1);}
.corp-client-chip i{font-size:.65rem;color:var(--ci-color,var(--primary));flex-shrink:0;}
.corp-cta-banner{display:flex;gap:3rem;align-items:flex-start;justify-content:space-between;flex-wrap:wrap;border:1px solid rgba(34,197,94,0.3);border-radius:var(--card-radius);padding:3rem;background:linear-gradient(135deg,rgba(34,197,94,0.05),rgba(56,189,248,0.03));position:relative;overflow:hidden;}
.corp-cta-glow{position:absolute;top:-80px;left:-80px;width:300px;height:300px;background:radial-gradient(circle,rgba(34,197,94,0.1),transparent 70%);pointer-events:none;}
.corp-cta-left{flex:1;min-width:260px;}
.corp-cta-right{display:flex;flex-direction:column;gap:.7rem;min-width:220px;}
.corp-perk{display:flex;align-items:center;gap:.7rem;font-size:.87rem;color:var(--text-main);}
.corp-perk i{color:var(--primary);font-size:.9rem;flex-shrink:0;}

/* ── CONTACT ── */
.contact-section{
  padding:5rem 4.5rem 7rem;
  position:relative;
}
.contact-header{margin-bottom:3.5rem;}
.contact-cards{
  display:grid;grid-template-columns:repeat(2,1fr);gap:1.8rem;
  max-width:640px;margin:0 auto;
}
.gratitude-note{
  max-width:640px;margin:2.5rem auto 0;
  text-align:center;
  padding:2rem 2.5rem;
  border:1px solid rgba(34,197,94,0.18);
  border-radius:20px;
  background:linear-gradient(135deg,rgba(34,197,94,0.04),rgba(56,189,248,0.03));
  position:relative;
}
.gratitude-heart{
  font-size:1.4rem;color:var(--primary);
  display:block;margin-bottom:.9rem;
  animation:pulse 2s ease-in-out infinite;
}
@keyframes pulse{0%,100%{transform:scale(1);opacity:1;}50%{transform:scale(1.15);opacity:.8;}}
.gratitude-line1{
  font-size:.97rem;color:var(--text-main);font-weight:500;
  line-height:1.7;margin-bottom:.5rem;
}
.gratitude-line2{
  font-size:.87rem;color:var(--text-muted);
  line-height:1.75;font-style:italic;
}
.contact-card{
  border:1px solid var(--border-subtle);
  border-radius:var(--card-radius);
  padding:2.5rem 2rem;
  background:rgba(5,8,22,0.7);
  backdrop-filter:blur(12px);
  display:flex;flex-direction:column;align-items:center;text-align:center;
  gap:.8rem;
  transition:transform .3s,border-color .3s,box-shadow .3s;
  position:relative;overflow:hidden;
}
.contact-card::before{
  content:'';position:absolute;inset:0;
  background:radial-gradient(circle at 50% 0%,var(--cc-glow,rgba(34,197,94,0.1)),transparent 65%);
  opacity:0;transition:.4s;
}
.contact-card:hover{
  transform:translateY(-6px);
  border-color:rgba(34,197,94,0.35);
  box-shadow:0 24px 55px rgba(0,0,0,0.5);
}
.contact-card:hover::before{opacity:1;}
.contact-card--featured{
  border-color:rgba(56,189,248,0.3);
  background:linear-gradient(160deg,rgba(56,189,248,0.05),rgba(5,8,22,0.85));
}
.contact-card--featured:hover{border-color:rgba(56,189,248,0.55);}
.contact-card-glow{
  position:absolute;top:-60px;left:50%;transform:translateX(-50%);
  width:180px;height:180px;border-radius:50%;
  background:radial-gradient(circle,rgba(56,189,248,0.12),transparent 70%);
  pointer-events:none;
}
.contact-icon{
  width:64px;height:64px;border-radius:20px;
  display:flex;align-items:center;justify-content:center;
  font-size:1.5rem;
  background:var(--cc-bg,rgba(34,197,94,0.1));
  border:1px solid var(--cc-border,rgba(34,197,94,0.3));
  color:var(--cc-color,var(--primary));
  position:relative;z-index:1;
  margin-bottom:.4rem;
  transition:transform .3s;
}
.contact-card:hover .contact-icon{transform:scale(1.08);}
.contact-card-title{
  font-size:1.05rem;font-weight:700;
  position:relative;z-index:1;
}
.contact-card-detail{
  font-size:.87rem;color:var(--text-muted);line-height:1.75;
  position:relative;z-index:1;
}
.contact-card-link{
  display:inline-flex;align-items:center;gap:.4rem;
  font-size:.8rem;color:var(--primary);text-decoration:none;
  letter-spacing:.05em;font-weight:600;margin-top:.4rem;
  position:relative;z-index:1;transition:.2s;
}
.contact-card-link:hover{gap:.7rem;color:var(--accent);}
.contact-card-link i{font-size:.7rem;transition:inherit;}

/* ── RESPONSIVE ── */
@media(max-width:1100px){
  .team-grid{grid-template-columns:repeat(2,1fr);}
  .corp-categories{grid-template-columns:repeat(2,1fr);}
}
@media(max-width:900px){
  section{padding:4rem 2rem;}
  .header{padding:1rem 2rem;}
  .nav-links{display:none;}
  .story-grid{grid-template-columns:1fr;gap:3rem;}
  .philosophy-grid{grid-template-columns:1fr;}
  .values-grid{grid-template-columns:1fr;}
  .timeline-section::before{left:2rem;}
  .timeline-item{grid-template-columns:60px 1fr;}
  .timeline-item:nth-child(odd) .tl-content,
  .timeline-item:nth-child(even) .tl-content{grid-column:2;text-align:left;}
  .timeline-item:nth-child(odd) .tl-empty,
  .timeline-item:nth-child(even) .tl-empty{display:none;}
  .tl-dot-col{grid-column:1 !important;}
  .tl-content{grid-column:2 !important;}
  .footer{padding:3rem 1.5rem 2rem;}
  .footer-content{grid-template-columns:1fr;}
}
@media(max-width:600px){
  .about-hero{padding:4rem 1.5rem 2rem;}
  .hero-stats{gap:1.5rem;}
  .team-grid{grid-template-columns:1fr;}
  .cta-section{padding:5rem 1.5rem;}
  .contact-cards{grid-template-columns:1fr;}
  .contact-section{padding:4rem 1.5rem 5rem;}
}
</style>
</head>
<body>

@include('navbar')
@include('cart')

<!-- PARTICLES -->
<div class="particles" id="particles"></div>

<main class="page">

  <!-- ── HERO ── -->
  <section class="about-hero">
    <div class="hero-eyebrow"><i class="fas fa-star"></i> Our Story</div>
    <h1 class="hero-title">
      <span class="line1">Crafting Worlds</span>
      <span class="line2">Through Scent</span>
    </h1>
    <p class="hero-desc">
      TROY was born from an obsession — to bottle the ineffable. We believe fragrance is the most intimate art form: invisible, yet unforgettable. Every drop we craft is a world waiting to be discovered.
    </p>
    <div class="hero-stats">
      <div class="stat-item">
        <div class="stat-num">40+</div>
        <div class="stat-label">Unique Fragrances</div>
      </div>
      <div class="stat-item">
        <div class="stat-num">6K+</div>
        <div class="stat-label">Happy Customers</div>
      </div>
      <div class="stat-item">
        <div class="stat-num">5</div>
        <div class="stat-label">Years of Mastery</div>
      </div>
    </div>
    <div class="scroll-hint">
      <span>Scroll to explore</span>
      <i class="fas fa-chevron-down"></i>
    </div>
  </section>

  <!-- ── STORY ── -->
  <section class="story-section">
    <div class="section-label">Our Origin</div>
    <div class="story-grid">
      <div class="story-visual">
        <div class="story-main-card">
          <div class="story-year">2021</div>
          <div class="story-founded">Founded in Lahore, Pakistan</div>
          <blockquote class="story-quote">
            "A perfume should tell a story that words can never fully capture."
          </blockquote>
        </div>
        <div class="story-float-badge">
          <i class="fas fa-user-tie"></i>
          <div>
            <strong>Farhan Javed</strong>
            <span>Founder & Master Perfumer</span>
          </div>
        </div>
      </div>

      <div class="story-text" style="padding-top:1rem;">
        <div class="section-title">From a dream to<br>a dynasty of scent</div>
        <p>TROY began in a small Lahore workshop where founder Farhan Javed mixed his first oud blend by candlelight. With nothing but an obsession for rare ingredients and an unshakeable belief that Pakistan deserved world-class perfumery, he poured everything into that first collection.</p>
        <p>Within months, those early bottles had begun reaching passionate fragrance lovers across Pakistan and beyond — shipped to customers who discovered TROY through word of mouth alone. Today, TROY stands at the intersection of Eastern tradition and contemporary luxury — a house that never forgets its roots while constantly reaching further.</p>
      </div>
    </div>
  </section>

  <!-- ── PHILOSOPHY ── -->
  <section class="philosophy-section">
    <div style="text-align:center;margin-bottom:1rem;">
      <div class="section-label" style="justify-content:center;">Scent Philosophy</div>
      <h2 class="section-title" style="text-align:center;">Three pillars of<br>every TROY creation</h2>
    </div>
    <div class="philosophy-grid">
      <div class="phil-card" style="--glow:rgba(34,197,94,0.1);--border-color:rgba(34,197,94,0.4);">
        <div class="phil-icon" style="--icon-bg:rgba(34,197,94,0.1);--icon-border:rgba(34,197,94,0.3);--icon-color:var(--primary);">
          <i class="fas fa-leaf"></i>
        </div>
        <div class="phil-title">Rare Ingredients</div>
        <div class="phil-desc">We source only the finest natural raw materials — from Himalayan cedarwood to Cambodian oud — because a masterpiece demands nothing less. Our master perfumer personally approves every ingredient batch.</div>
      </div>
      <div class="phil-card" style="--glow:rgba(56,189,248,0.1);--border-color:rgba(56,189,248,0.4);">
        <div class="phil-icon" style="--icon-bg:rgba(56,189,248,0.1);--icon-border:rgba(56,189,248,0.3);--icon-color:var(--accent);">
          <i class="fas fa-infinity"></i>
        </div>
        <div class="phil-title">Timeless Artistry</div>
        <div class="phil-desc">Trend cycles are noise. We craft scents designed to outlast seasons, fads, and fleeting fashions — fragrances that earn a permanent place in the stories of those who wear them.</div>
      </div>
      <div class="phil-card" style="--glow:rgba(234,179,8,0.08);--border-color:rgba(234,179,8,0.4);">
        <div class="phil-icon" style="--icon-bg:rgba(234,179,8,0.1);--icon-border:rgba(234,179,8,0.3);--icon-color:#eab308;">
          <i class="fas fa-heart"></i>
        </div>
        <div class="phil-title">Emotional Truth</div>
        <div class="phil-desc">Every scent has a mood, a memory, an emotion at its core. We design from feeling first — composing each fragrance around a human experience rather than a trend report.</div>
      </div>
    </div>
  </section>

  <!-- ── TEAM ── -->
  <section class="team-section">
    <div class="team-header">
      <div>
        <div class="section-label">The People</div>
        <h2 class="section-title">The minds behind<br>the magic</h2>
      </div>
      <p class="section-sub" style="max-width:320px;font-size:.88rem;">Our team of perfumers, designers, and storytellers share one obsession: creating scents that move people.</p>
    </div>
    <div class="team-grid">
      <div class="team-card">
        <div class="team-avatar" style="--av-bg:linear-gradient(135deg,rgba(34,197,94,0.2),rgba(56,189,248,0.1));">
          <svg viewBox="0 0 120 120" width="90" height="90" xmlns="http://www.w3.org/2000/svg" style="z-index:1;position:relative;">
            <circle cx="60" cy="44" r="26" fill="rgba(34,197,94,0.25)" stroke="rgba(34,197,94,0.6)" stroke-width="2"/>
            <path d="M20 105 Q20 78 60 78 Q100 78 100 105" fill="rgba(34,197,94,0.2)" stroke="rgba(34,197,94,0.5)" stroke-width="2"/>
            <circle cx="60" cy="44" r="14" fill="rgba(34,197,94,0.5)"/>
            <text x="60" y="50" text-anchor="middle" font-size="16" fill="#fff" font-family="Poppins,sans-serif" font-weight="700">FJ</text>
          </svg>
        </div>
        <div class="team-info">
          <div class="team-name">Farhan Javed</div>
          <div class="team-role">Founder, Website Developer & Master Perfumer</div>
          <div class="team-bio">The visionary behind TROY. With a deep-rooted passion for rare ingredients and Eastern fragrance heritage, Farhan built TROY from a single workshop into a global luxury house.</div>
          <div class="team-socials">
            <button class="social-btn"><i class="fab fa-instagram"></i></button>
            <button class="social-btn"><i class="fab fa-linkedin"></i></button>
          </div>
        </div>
      </div>
      <div class="team-card">
        <div class="team-avatar" style="--av-bg:linear-gradient(135deg,rgba(56,189,248,0.2),rgba(34,197,94,0.1));">
          <svg viewBox="0 0 120 120" width="90" height="90" xmlns="http://www.w3.org/2000/svg" style="z-index:1;position:relative;">
            <circle cx="60" cy="44" r="26" fill="rgba(56,189,248,0.25)" stroke="rgba(56,189,248,0.6)" stroke-width="2"/>
            <path d="M20 105 Q20 78 60 78 Q100 78 100 105" fill="rgba(56,189,248,0.2)" stroke="rgba(56,189,248,0.5)" stroke-width="2"/>
            <circle cx="60" cy="44" r="14" fill="rgba(56,189,248,0.5)"/>
            <text x="60" y="50" text-anchor="middle" font-size="16" fill="#fff" font-family="Poppins,sans-serif" font-weight="700">SM</text>
          </svg>
        </div>
        <div class="team-info">
          <div class="team-name">Sana Mirza</div>
          <div class="team-role">Creative Director</div>
          <div class="team-bio">Visual architect of the TROY universe. Sana ensures every bottle, box, and campaign is a work of art in its own right.</div>
          <div class="team-socials">
            <button class="social-btn"><i class="fab fa-instagram"></i></button>
            <button class="social-btn"><i class="fab fa-behance"></i></button>
          </div>
        </div>
      </div>
      <div class="team-card">
        <div class="team-avatar" style="--av-bg:linear-gradient(135deg,rgba(234,179,8,0.18),rgba(34,197,94,0.08));">
          <svg viewBox="0 0 120 120" width="90" height="90" xmlns="http://www.w3.org/2000/svg" style="z-index:1;position:relative;">
            <circle cx="60" cy="44" r="26" fill="rgba(234,179,8,0.2)" stroke="rgba(234,179,8,0.6)" stroke-width="2"/>
            <path d="M20 105 Q20 78 60 78 Q100 78 100 105" fill="rgba(234,179,8,0.15)" stroke="rgba(234,179,8,0.5)" stroke-width="2"/>
            <circle cx="60" cy="44" r="14" fill="rgba(234,179,8,0.45)"/>
            <text x="60" y="50" text-anchor="middle" font-size="16" fill="#fff" font-family="Poppins,sans-serif" font-weight="700">IB</text>
          </svg>
        </div>
        <div class="team-info">
          <div class="team-name">Ibrahim</div>
          <div class="team-role">Head of Digital Channels</div>
          <div class="team-bio">Drives TROY's digital presence and online strategy, ensuring the brand reaches fragrance lovers across every platform and market.</div>
          <div class="team-socials">
            <button class="social-btn"><i class="fab fa-instagram"></i></button>
            <button class="social-btn"><i class="fab fa-twitter"></i></button>
          </div>
        </div>
      </div>
      <div class="team-card">
        <div class="team-avatar" style="--av-bg:linear-gradient(135deg,rgba(167,139,250,0.2),rgba(56,189,248,0.1));">
          <svg viewBox="0 0 120 120" width="90" height="90" xmlns="http://www.w3.org/2000/svg" style="z-index:1;position:relative;">
            <circle cx="60" cy="44" r="26" fill="rgba(167,139,250,0.25)" stroke="rgba(167,139,250,0.6)" stroke-width="2"/>
            <path d="M20 105 Q20 78 60 78 Q100 78 100 105" fill="rgba(167,139,250,0.2)" stroke="rgba(167,139,250,0.5)" stroke-width="2"/>
            <circle cx="60" cy="44" r="14" fill="rgba(167,139,250,0.5)"/>
            <text x="60" y="50" text-anchor="middle" font-size="16" fill="#fff" font-family="Poppins,sans-serif" font-weight="700">NH</text>
          </svg>
        </div>
        <div class="team-info">
          <div class="team-name">Nadia Hussain</div>
          <div class="team-role">Brand Experience Lead</div>
          <div class="team-bio">Designs every touchpoint from the unboxing ritual to the in-store atmosphere, crafting experiences as memorable as our scents.</div>
          <div class="team-socials">
            <button class="social-btn"><i class="fab fa-instagram"></i></button>
            <button class="social-btn"><i class="fab fa-linkedin"></i></button>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ── TIMELINE ── -->
  <section class="timeline-section">
    <div class="timeline-header">
      <div class="section-label" style="justify-content:center;">Milestones</div>
      <h2 class="section-title">A decade of<br>extraordinary chapters</h2>
    </div>
    <div class="timeline">

      <div class="timeline-item">
        <div class="tl-empty"></div>
        <div class="tl-dot-col"><div class="tl-dot"><i class="fas fa-seedling"></i></div></div>
        <div class="tl-content">
          <div class="tl-year">2021</div>
          <div class="tl-title">The First Workshop</div>
          <div class="tl-desc">Farhan Javed creates TROY's founding collection in a small Lahore atelier. Word spreads quietly but powerfully.</div>
        </div>
      </div>

      <div class="timeline-item">
        <div class="tl-content">
          <div class="tl-year">2024</div>
          <div class="tl-title">First International Shipment</div>
          <div class="tl-desc">TROY's very first international order ships to Doha, Qatar — to Tahir Khan, Head of IT — marking the beginning of a global chapter built one loyal customer at a time.</div>
        </div>
        <div class="tl-dot-col"><div class="tl-dot"><i class="fas fa-globe"></i></div></div>
        <div class="tl-empty"></div>
      </div>

      <div class="timeline-item">
        <div class="tl-empty"></div>
        <div class="tl-dot-col"><div class="tl-dot" style="border-color:var(--accent);color:var(--accent);box-shadow:0 0 20px rgba(56,189,248,0.3);"><i class="fas fa-microchip"></i></div></div>
        <div class="tl-content">
          <div class="tl-year">2026</div>
          <div class="tl-title">Digital Transformation</div>
          <div class="tl-desc">Launching an AI-powered scent recommendation engine, TROY becomes one of South Asia's first tech-forward luxury fragrance brands.</div>
        </div>
      </div>

    </div>
  </section>

  <!-- ── VALUES ── -->
  <section class="values-section">
    <div class="values-header">
      <div class="section-label">What We Stand For</div>
      <h2 class="section-title">The TROY promise</h2>
    </div>
    <div class="values-grid">
      <div class="value-card">
        <div class="value-num">01</div>
        <div class="value-body">
          <div class="value-title">Uncompromising Quality</div>
          <div class="value-text">We refuse to substitute a natural ingredient with a synthetic shortcut. If the harvest is poor, we wait. Quality is the only metric that matters.</div>
        </div>
      </div>
      <div class="value-card">
        <div class="value-num">02</div>
        <div class="value-body">
          <div class="value-title">Cultural Pride</div>
          <div class="value-text">TROY celebrates the rich olfactory heritage of Pakistan and the East. Our roots are our greatest strength, not something to hide behind Western influence.</div>
        </div>
      </div>
      <div class="value-card">
        <div class="value-num">03</div>
        <div class="value-body">
          <div class="value-title">Sustainable Luxury</div>
          <div class="value-text">We partner only with ethical growers, use recycled packaging where possible, and invest in reforestation initiatives for every oud tree sourced.</div>
        </div>
      </div>
      <div class="value-card">
        <div class="value-num">04</div>
        <div class="value-body">
          <div class="value-title">Radical Transparency</div>
          <div class="value-text">We publish our ingredient origins and disclose our sustainability metrics. Luxury should not require secrecy.</div>
        </div>
      </div>
    </div>
  </section>

  <!-- ── CORPORATE CUSTOMERS ── -->
  <section class="corporate-section">
    <div class="corporate-header">
      <div>
        <div class="section-label">Corporate Clients</div>
        <h2 class="section-title">Trusted by businesses<br>that demand the best</h2>
        <p class="section-sub">From luxury hotels to leading corporations, TROY fragrances elevate workspaces, hospitality environments, and gifting programmes across industries.</p>
      </div>
      <div class="corp-stats-row">
        <div class="corp-stat"><span class="corp-stat-num">50+</span><span class="corp-stat-label">Corporate Clients</span></div>
        <div class="corp-stat"><span class="corp-stat-num">12</span><span class="corp-stat-label">Industries Served</span></div>
        <div class="corp-stat"><span class="corp-stat-num">100%</span><span class="corp-stat-label">Reorder Rate</span></div>
      </div>
    </div>

    <div class="corp-cta-banner">
      <div class="corp-cta-glow"></div>
      <div class="corp-cta-left">
        <div style="font-size:.72rem;letter-spacing:.18em;text-transform:uppercase;color:var(--primary);margin-bottom:.6rem;display:flex;align-items:center;gap:.5rem;">
          <i class="fas fa-handshake"></i> Corporate Partnerships
        </div>
        <div style="font-size:1.5rem;font-weight:800;line-height:1.2;margin-bottom:.5rem;">Ready to bring TROY<br>into your organisation?</div>
        <div style="font-size:.88rem;color:var(--text-muted);line-height:1.7;">Custom fragrance programmes, bulk gifting, branded packaging, and dedicated account management — tailored entirely to your brand and budget.</div>
      </div>
      <div class="corp-cta-right">
        <div class="corp-perk"><i class="fas fa-check-circle"></i> Dedicated account manager</div>
        <div class="corp-perk"><i class="fas fa-check-circle"></i> Custom branding &amp; packaging</div>
        <div class="corp-perk"><i class="fas fa-check-circle"></i> Flexible MOQs</div>
        <div class="corp-perk"><i class="fas fa-check-circle"></i> Priority fulfilment</div>
        <button class="btn-primary" style="margin-top:1.5rem;padding:.75rem 1.8rem;">
          <i class="fas fa-envelope" style="margin-right:.5rem;"></i>Enquire Now
        </button>
      </div>
    </div>

  </section>

  <!-- ── CEO MESSAGE ── -->
  <section style="padding:4rem 4.5rem 2rem;">
    <div style="max-width:860px;margin:0 auto;">
      <div class="section-label" style="justify-content:center;margin-bottom:2.5rem;display:flex;">A Message From Our CEO</div>
      <div style="
        background:linear-gradient(135deg,rgba(34,197,94,0.06),rgba(56,189,248,0.04));
        border:1px solid rgba(34,197,94,0.25);
        border-radius:var(--card-radius);
        padding:3rem 3.5rem;
        position:relative;overflow:hidden;
      ">
        <!-- decorative quote mark -->
        <div style="
          position:absolute;top:-10px;left:2.5rem;
          font-size:9rem;line-height:1;
          color:rgba(34,197,94,0.08);font-family:Georgia,serif;
          pointer-events:none;user-select:none;
        ">"</div>
        <!-- glow -->
        <div style="
          position:absolute;top:-60px;right:-60px;width:200px;height:200px;
          background:radial-gradient(circle,rgba(56,189,248,0.1),transparent 70%);
          pointer-events:none;
        "></div>

        <p style="font-size:1.12rem;line-height:1.9;color:var(--text-main);font-weight:300;font-style:italic;position:relative;z-index:1;margin-bottom:1.8rem;">
          "When I blended that first bottle in 2021, I wasn't thinking about a brand or a business — I was simply chasing a feeling. I wanted to capture the scent of the night air over Lahore, the warmth of saffron in a winter kitchen, the quiet elegance of oud that lingers long after the conversation ends. TROY is that pursuit, made tangible. Every fragrance we release is a personal promise: that we will never cut corners, never chase trends, and never stop asking what beauty can become. Thank you for being part of this journey — it means everything."
        </p>

        <div style="display:flex;align-items:center;gap:1.2rem;position:relative;z-index:1;">
          <div style="
            width:54px;height:54px;border-radius:50%;
            background:linear-gradient(135deg,rgba(34,197,94,0.3),rgba(56,189,248,0.2));
            border:2px solid rgba(34,197,94,0.5);
            display:flex;align-items:center;justify-content:center;
            font-size:.85rem;font-weight:700;color:var(--primary);letter-spacing:.05em;
          ">FJ</div>
          <div>
            <div style="font-size:1rem;font-weight:700;color:var(--text-main);">Farhan Javed</div>
            <div style="font-size:.75rem;color:var(--primary);letter-spacing:.12em;text-transform:uppercase;margin-top:.2rem;">Founder, Website Developer & CEO, TROY Perfumes</div>
          </div>
          <div style="margin-left:auto;">
            <svg width="80" height="36" viewBox="0 0 80 36" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M4 28 C10 10, 24 8, 30 20 C34 28, 38 4, 50 10 C58 14, 60 24, 76 18" stroke="rgba(34,197,94,0.5)" stroke-width="2" fill="none" stroke-linecap="round"/>
            </svg>
            <div style="font-size:.65rem;color:var(--text-muted);letter-spacing:.1em;text-transform:uppercase;margin-top:.2rem;text-align:right;">Signature</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ── CTA ── -->
  <section class="cta-section">
    <h2 class="cta-title">Join the<br>TROY world</h2>
    <p class="cta-sub">Connect with us, explore our collections, or reach out — we'd love to hear from you.</p>
    <div class="cta-btns">
      <button class="btn-primary" style="padding:.85rem 2rem;font-size:.95rem;">
        <i class="fas fa-envelope" style="margin-right:.5rem"></i>Get In Touch
      </button>
      <button class="btn-ghost">
        <i class="fas fa-flask"></i>View Collections
      </button>
    </div>
  </section>

  <!-- ── GET IN TOUCH ── -->
  <section class="contact-section">
    <div class="contact-header">
      <h2 class="section-title" style="text-align:center;">Get In Touch</h2>
      <p style="text-align:center;color:var(--text-muted);margin-top:.5rem;">We'd love to hear from you</p>
    </div>
    <div class="contact-cards">

      <div class="contact-card contact-card--featured">
        <div class="contact-card-glow"></div>
        <div class="contact-icon" style="--cc-bg:rgba(56,189,248,0.12);--cc-border:rgba(56,189,248,0.4);--cc-color:var(--accent);--cc-glow:rgba(56,189,248,0.15);">
          <i class="fas fa-phone"></i>
        </div>
        <div class="contact-card-title">Call Us</div>
        <div class="contact-card-detail">+1 (800) 555-TROY<br>Mon – Fri: 9AM – 8PM</div>
        <a href="tel:+18005557769" class="contact-card-link">Call Now <i class="fas fa-arrow-right"></i></a>
      </div>

      <div class="contact-card">
        <div class="contact-icon" style="--cc-bg:rgba(34,197,94,0.1);--cc-border:rgba(34,197,94,0.3);--cc-color:var(--primary);--cc-glow:rgba(34,197,94,0.15);">
          <i class="fas fa-envelope"></i>
        </div>
        <div class="contact-card-title">Email Us</div>
        <div class="contact-card-detail">hello@troyperfumes.com<br>support@troyperfumes.com</div>
        <a href="mailto:hello@troyperfumes.com" class="contact-card-link">Send Email <i class="fas fa-arrow-right"></i></a>
      </div>

    </div>

    <!-- GRATITUDE NOTE -->
    <div class="gratitude-note">
      <i class="fas fa-heart gratitude-heart"></i>
      <p class="gratitude-line1">Thank you for taking the time to learn our story — it means the world to us.</p>
      <p class="gratitude-line2">Every bottle of TROY carries a piece of our heart, made for people who appreciate the extraordinary.</p>
    </div>

</main>

<!-- FOOTER -->
<footer class="footer">
<div class="footer-content">
<div class="footer-column">
<img alt="TROY Perfumes Logo" class="footer-logo" id="footerLogo" src="{{ asset('troy.png') }}"/>
<h3>TROY Perfumes</h3>
<p style="color:var(--text-muted);margin-bottom:1.2rem;">
                    Luxury impressions crafted with precision and passion. Designed for Pakistani weather and routines.
                </p>
<div class="social-links">
<a aria-label="Facebook" class="social-link" href="#"><i class="fab fa-facebook-f"></i></a>
<a aria-label="Instagram" class="social-link" href="#"><i class="fab fa-instagram"></i></a>
<a aria-label="YouTube" class="social-link" href="#"><i class="fab fa-youtube"></i></a>
</div>
</div>
<div class="footer-column">
<h3>Shop</h3>
<ul class="footer-links">
<li><a href="#">Bestsellers</a></li>
<li><a href="#">Seasonal Collection</a></li>
<li><a href="#">Gift Sets</a></li>
<li><a href="#">Oud &amp; Amber</a></li>
<li><a href="#">Fresh &amp; Citrus</a></li>
</ul>
</div>
<div class="footer-column">
<h3>Help</h3>
<ul class="footer-links">
<li><a href="#">WhatsApp Support</a></li>
<li><a href="#">Shipping &amp; Returns</a></li>
<li><a href="#">FAQ</a></li>
<li><a href="#">Store Locator</a></li>
<li><a href="#">Privacy Policy</a></li>
</ul>
</div>
<div class="footer-column">
<h3>Newsletter</h3>
<p style="color:var(--text-muted);margin-bottom:1rem;">
                    Subscribe for new drops, flash sales and VIP early access.
                </p>
<form id="newsletterForm" style="display:flex;gap:10px;">
<input placeholder="Your email" required="" style="
                        flex:1;
                        padding:12px 18px;
                        border-radius:30px;
                        border:1px solid rgba(148,163,184,0.5);
                        background:var(--bg-elevated);
                        color:var(--text-main);
                        outline:none;
                        font-size:.95rem;
                    " type="email"/>
<button style="
                        padding:12px 24px;
                        border-radius:30px;
                        background:var(--primary);
                        color:#022c22;
                        border:none;
                        cursor:pointer;
                        font-weight:600;
                        transition:all .3s;
                    " type="submit">Subscribe</button>
</form>
</div>
</div>
<div class="footer-bottom">
<p>© 2025 TROY Perfumes. All rights reserved. | 2% of your amount will be served in name of Allah.</p>
</div>
</footer>

<script>
// PARTICLES
(function(){
  const container = document.getElementById('particles');
  for(let i=0;i<30;i++){
    const p = document.createElement('div');
    p.className = 'particle';
    p.style.cssText = `
      --left:${Math.random()*100}%;
      --dur:${6+Math.random()*10}s;
      --delay:${Math.random()*10}s;
      width:${2+Math.random()*4}px;
      height:${2+Math.random()*4}px;
      opacity:${0.3+Math.random()*0.5};
      background:${Math.random()>.5?'rgba(34,197,94,0.6)':'rgba(56,189,248,0.6)'};
    `;
    container.appendChild(p);
  }
})();

// INTERSECTION OBSERVER: fade-in sections
const observer = new IntersectionObserver((entries)=>{
  entries.forEach(e=>{
    if(e.isIntersecting){
      e.target.style.opacity='1';
      e.target.style.transform='translateY(0)';
    }
  });
},{threshold:0.1});
document.querySelectorAll('.phil-card,.team-card,.tl-content,.value-card').forEach(el=>{
  el.style.opacity='0';
  el.style.transform='translateY(24px)';
  el.style.transition='opacity .6s ease, transform .6s ease';
  observer.observe(el);
});
</script>
</body>
</html>
