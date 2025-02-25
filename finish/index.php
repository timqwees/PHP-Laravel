<?php
require_once __DIR__ . '/system/helpers.php';
checkAuth();
$user = currentUser();
?>
<!DOCTYPE html>
<html data-wf-domain="timqwees.technology" data-wf-page="645cebca0c6ed9d1ed21ecdb"
  data-wf-site="637359c81e22b715cec245ad" lang="ru">

<head>
  <meta charset="UTF-8" />
  <title>TimQwees Technology - Account</title>
  <meta content="Пройдите регистрацию, чтобы пере" name="description" />
  <meta content="TimQwees Technology" property="og:title" />
  <meta content="Пройдите регистрацию, чтобы перейти в онлайн чат политеха" property="og:description" />
  <meta content="src/timqwees/favicon.ico" property="og:image" />
  <meta property="og:type" content="website" />
  <meta content="width=device-width, initial-scale=1" name="viewport" />
  <link defer="defer" rel="shortcut icon" href="src/timqwees/favicon.ico" type="image/x-icon">
  <style>
    /* Copyright (c) 2025 by Leonam Silva de Souza (https://codepen.io/leonam-silva-de-souza/pen/vYowKqP) */
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

    :root {
      --bg-gradient-onyx: linear-gradient(to bottom right, hsl(240, 1%, 25%) 3%, hsl(0, 0%, 19%) 97%);
      --bg-gradient-jet: linear-gradient(to bottom right, hsla(240, 1%, 18%, .251) 3%, hsla(240, 2%, 11%, 0) 100%), hsl(240, 2%, 13%);
      --bg-gradient-yellow1: linear-gradient(to bottom right, hsl(45, 100%, 71%) 0%, hsla(36, 100%, 69%, 0) 50%);
      --bg-gradient-yellow2: linear-gradient(135deg, hsla(45, 100%, 71%, .251) 0%, hsla(35, 100%, 68%, 0) 59.86%), hsl(240, 2%, 13%);
      --border-gradient-onyx: linear-gradient(to bottom right, hsl(0, 0%, 25%) 0%, hsla(0, 0%, 25%, 0) 50%);
      --text-gradient-yellow: linear-gradient(to right, hsl(45, 100%, 72%), hsl(35, 100%, 68%));

      --jet: hsl(0, 0%, 22%);
      --onyx: hsl(240, 1%, 17%);
      --eerie-black1: hsl(240, 2%, 13%);
      --eerie-black2: hsl(240, 2%, 12%);
      --smoky-black: hsl(0, 0%, 7%);
      --white1: hsl(0, 0%, 100%);
      --white2: hsl(0, 0%, 98%);
      --orange-yellow-crayola: hsl(45, 100%, 72%);
      --vegas-gold: hsl(45, 54%, 58%);
      --light-gray: hsl(0, 0%, 84%);
      --light-gray70: hsla(0, 0%, 84%, .7);
      --bittersweet-shimmer: hsl(0, 43%, 51%);

      --ff-poppins: 'Poppins', sans-serif;

      --fs1: 24px;
      --fs2: 18px;
      --fs3: 17px;
      --fs4: 16px;
      --fs5: 15px;
      --fs6: 14px;
      --fs7: 13px;
      --fs8: 12px;

      --fw300: 300;
      --fw400: 400;
      --fw500: 500;
      --fw600: 600;

      --shadow1: -4px 8px 24px hsla(0, 0%, 0%, .25);
      --shadow2: 0px 16px 30px hsla(0, 0%, 0%, .25);
      --shadow3: 0px 16px 40px hsla(0, 0%, 0%, .25);
      --shadow4: 0px 25px 50px hsla(0, 0%, 0%, .15);
      --shadow5: 0px 24px 80px hsla(0, 0%, 0%, .25);

      --transition1: .25s ease;
      --transition2: .5s ease-in-out;
    }

    *,
    *::before,
    *::after {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    a {
      text-decoration: none;
    }

    li {
      list-style: none;
    }

    img,
    ion-icon,
    a,
    button,
    time,
    span {
      display: block;
    }

    button {
      font: inherit;
      background: none;
      border: none;
      text-align: left;
      cursor: pointer;
    }

    input,
    textarea {
      display: block;
      width: 100%;
      background: none;
      font: inherit;
    }

    ::selection {
      background: var(--orange-yellow-crayola);
      color: var(--smoky-black);
    }

    :focus {
      outline-color: var(--orange-yellow-crayola);
    }

    html {
      font-family: var(--ff-poppins);
    }

    body {
      background: var(--smoky-black);
    }

    main {
      margin: 15px 12px;
      margin-bottom: 75px;
      min-width: 259px;
    }

    .sidebar,
    article {
      background: var(--eerie-black2);
      border: 1px solid var(--jet);
      border-radius: 20px;
      box-shadow: var(--shadow1);
      z-index: 1;
      padding: 15px;
    }

    .sidebar.active {
      max-height: 405px;
    }

    .separator {
      width: 100%;
      height: 1px;
      background: var(--jet);
      margin: 16px 0;
    }

    .icon-box {
      position: relative;
      background: var(--border-gradient-onyx);
      width: 30px;
      height: 30px;
      border-radius: 8px;
      display: flex;
      justify-content: center;
      align-items: center;
      font-size: 16px;
      color: var(--orange-yellow-crayola);
      box-shadow: var(--shadow1);
      z-index: 1;
    }

    .icon-box::before {
      content: '';
      position: absolute;
      inset: 1px;
      background: var(--eerie-black1);
      border-radius: inherit;
      z-index: -1;
    }

    .icon-box ion-icon {
      --ionicon-stroke-width: 35px;
    }

    article {
      display: none;
    }

    article.active {
      display: block;
      animation: fade .5s ease backwards;
    }

    @keyframes fade {
      0% {
        opacity: 0;
      }

      100% {
        opacity: 1;
      }
    }

    .h2,
    .h3,
    .h4,
    .h5 {
      color: var(--white2);
      text-transform: capitalize;
    }

    .h2 {
      font-size: var(--fs1);
    }

    .h3 {
      font-size: var(--fs2);
    }

    .h4 {
      font-size: var(--fs4);
    }

    .h5 {
      font-size: var(--fs7);
      font-weight: var(--fw500);
    }

    .article-title {
      position: relative;
      padding-bottom: 7px;
    }

    .article-title::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      width: 30px;
      height: 3px;
      background: var(--text-gradient-yellow);
      border-radius: 3px;
    }

    .has-scrollbar::-webkit-scrollbar {
      width: 5px;
      height: 5px;
    }

    .has-scrollbar::-webkit-scrollbar-track {
      background: var(--onyx);
      border-radius: 5px;
    }

    .has-scrollbar::-webkit-scrollbar-thumb {
      background: var(--orange-yellow-crayola);
      border-radius: 5px;
    }

    .has-scrollbar::-webkit-scrollbar-button {
      width: 20px;
    }

    .content-card {
      position: relative;
      background: var(--border-gradient-onyx);
      padding: 15px;
      padding-top: 45px;
      border-radius: 14px;
      box-shadow: var(--shadow2);
      cursor: pointer;
      z-index: 1;
    }

    .content-card::before {
      content: '';
      position: absolute;
      inset: 1px;
      background: var(--bg-gradient-jet);
      border-radius: inherit;
      z-index: -1;
    }

    /*ASIDE - SIDEBAR*/

    .sidebar {
      margin-bottom: 15px;
      max-height: 112px;
      overflow: hidden;
      padding: 15px;
      transition: var(--transition2);
    }

    .sidebar-info {
      position: relative;
      display: flex;
      justify-content: flex-start;
      align-items: center;
      gap: 15px;
    }



    .avatar-box {
      background: var(--bg-gradient-onyx);
      border-radius: 20px;
    }

    .info-content .name {
      color: var(--white2);
      font-size: var(--fs3);
      font-weight: var(--fw500);
      letter-spacing: -0.25px;
      margin-bottom: 10px;
    }

    .info-content .title {
      color: var(--white1);
      background: var(--onyx);
      font-size: var(--fs8);
      font-weight: var(--fw300);
      width: max-content;
      padding: 3px 12px;
      border-radius: 8px;
    }

    .info-more-btn {
      position: absolute;
      top: -15px;
      right: -15px;
      border-radius: 0 15px;
      font-size: 13px;
      color: var(--orange-yellow-crayola);
      background: var(--border-gradient-onyx);
      padding: 10px;
      box-shadow: var(--shadow2);
      transition: var(--transition1);
      z-index: 1;
    }

    .info-more-btn::before {
      content: '';
      position: absolute;
      inset: 1px;
      border-radius: inherit;
      background: var(--bg-gradient-jet);
      transition: var(--transition1);
      z-index: -1;
    }

    .info-more-btn:hover,
    .info-more-btn:focus {
      background: var(--bg-gradient-yellow1);
    }

    .info-more-btn:hover::before,
    .info-more-btn:focus::before {
      background: var(--bg-gradient-yellow2);
    }

    .info-more-btn span {
      display: none;
    }

    .sidebar-info-more {
      opacity: 0;
      visibility: hidden;
      transition: var(--transition2);
    }

    .sidebar.active .sidebar-info-more {
      opacity: 1;
      visibility: visible;
    }

    .contacts-list {
      display: grid;
      grid-template-columns: 1fr;
      gap: 16px;
    }

    .contact-item {
      min-width: 100%;
      display: flex;
      align-items: center;
      gap: 16px;
    }

    .contact-info {
      max-width: calc(100% - 46px);
      width: calc(100% - 46px);
    }

    .contact-info :is(.contact-link, time, address) {
      color: var(--white2);
      font-size: var(--fs7);
    }

    .contact-info address {
      font-style: normal;
    }

    .contact-title {
      color: var(--light-gray70);
      font-size: var(--fs8);
      text-transform: uppercase;
      margin-bottom: 2px;
    }

    .social-list {
      display: flex;
      justify-content: flex-start;
      align-items: center;
      gap: 15px;
      padding-bottom: 4px;
      padding-left: 7px;
    }

    .social-item .social-link {
      color: var(--light-gray70);
      font-size: 18px;
    }

    .social-item .social-link:hover {
      color: var(--light-gray);
    }

    /*NAVBAR*/

    .navbar {
      position: fixed;
      bottom: 0;
      left: 0;
      width: 100%;
      background: hsla(240, 1%, 17%, .75);
      backdrop-filter: blur(10px);
      border: 1px solid var(--jet);
      border-radius: 12px 12px 0 0;
      box-shadow: var(--shadow2);
      z-index: 5;
    }

    .navbar-list {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      align-items: center;
      padding: 0 10px;
    }

    .navbar-link {
      color: var(--light-gray);
      font-size: var(--fs8);
      padding: 20px 7px;
      transition: color var(--transition1);
    }

    .navbar-link:hover,
    .navbar-link:focus {
      color: var(--light-gray70);
    }

    .navbar-link.active {
      color: var(--orange-yellow-crayola);
    }

    /*ABOUT*/

    .about .article-title {
      margin-bottom: 15px;
      margin-top: 15px;
    }

    .about-text {
      color: var(--light-gray);
      font-size: var(--fs6);
      font-weight: var(--fw300);
      line-height: 1.6;
    }

    .about-text p {
      margin-bottom: 15px;
      text-align: justify;
      padding-left: 10px;
      padding-right: 10px;
    }

    .service {
      margin-bottom: 35px;
    }

    .service-title {
      margin-bottom: 20px;
    }

    .service-list {
      display: grid;
      grid-template-columns: 1fr;
      gap: 20px;
    }

    .service-item {
      position: relative;
      background: var(--border-gradient-onyx);
      padding: 20px;
      border-radius: 14px;
      box-shadow: var(--shadow2);
      z-index: 1;
    }

    .service-item::before {
      content: '';
      position: absolute;
      inset: 1px;
      background: var(--bg-gradient-jet);
      border-radius: inherit;
      z-index: -1;
    }

    .service-icon-box {
      margin-bottom: 10px;
    }

    .service-icon-box img {
      margin: auto;
    }

    .service-content-box {
      text-align: center;
    }

    .service-item-title {
      margin-bottom: 7px;
    }

    .service-item-text {
      color: var(--light-gray);
      font-size: var(--fs6);
      font-weight: var(--fw300);
      line-height: 1.6;
    }

    /*TESTIMONIALS*/

    .testimonials {
      margin-bottom: 30px;
    }

    .testimonials-title {
      margin-bottom: 20px;
    }

    .testimonials-list {
      display: flex;
      justify-content: flex-start;
      align-items: flex-start;
      gap: 15px;
      margin: 0 -15px;
      padding: 25px 15px;
      padding-bottom: 35px;
      overflow-x: auto;
      scroll-behavior: smooth;
      overscroll-behavior-inline: contain;
      scroll-snap-type: inline mandatory;
    }

    .testimonials-item {
      min-width: 100%;
      scroll-snap-align: center;
    }

    .testimonials-avatar-box {
      position: absolute;
      top: 0;
      left: 0;
      transform: translate(15px, -25px);
      background: var(--bg-gradient-onyx);
      border-radius: 14px;
      box-shadow: var(--shadow1);
    }

    .testimonials-text {
      color: var(--light-gray);
      font-size: var(--fs6);
      font-weight: var(--fw300);
      line-height: 1.6;
      display: -webkit-box;
      line-clamp: 4;
      -webkit-line-clamp: 4;
      -webkit-box-orient: vertical;
      overflow: hidden;
    }

    /*MODAL CONTAINER*/

    .modal-container {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      display: flex;
      justify-content: center;
      align-items: center;
      overflow-y: auto;
      overscroll-behavior: contain;
      z-index: 20;
      pointer-events: none;
      visibility: hidden;
    }

    .modal-container::-webkit-scrollbar {
      display: none;
    }

    .modal-container.active {
      pointer-events: all;
      visibility: visible;
    }

    .modal-container.active .testimonials-modal {
      transform: scale(1);
      opacity: 1;
    }

    .overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100vh;
      background: hsl(0, 0%, 5%);
      opacity: 0;
      visibility: hidden;
      pointer-events: none;
      z-index: 1;
      transition: var(--transition1);
    }

    .overlay.active {
      opacity: .8;
      visibility: visible;
      pointer-events: all;
    }

    .testimonials-modal {
      background: var(--eerie-black2);
      position: relative;
      padding: 15px;
      margin: 15px 12px;
      border: 1px solid var(--jet);
      border-radius: 14px;
      box-shadow: var(--shadow5);
      transform: scale(1.2);
      opacity: 0;
      transition: var(--transition1);
      z-index: 2;
    }

    .modal-close-btn {
      position: absolute;
      top: 15px;
      right: 15px;
      background: var(--onyx);
      border-radius: 8px;
      width: 32px;
      height: 32px;
      display: flex;
      justify-content: center;
      align-items: center;
      color: var(--white2);
      font-size: 18px;
      opacity: .7;
    }

    .modal-close-btn:hover,
    .modal-close-btn:focus {
      opacity: 1;
    }

    .modal-close-btn ion-icon {
      --ionicon-stroke-width: 50px;
    }

    .modal-avatar-box {
      background: var(--bg-gradient-onyx);
      width: max-content;
      border-radius: 14px;
      margin-bottom: 15px;
      box-shadow: var(--shadow2);
    }

    .modal-img-wrapper>img {
      display: none;
    }

    .modal-title {
      margin-bottom: 4px;
    }

    .modal-content time {
      font-size: var(--fs6);
      color: var(--light-gray70);
      font-weight: var(--fw500);
      margin-bottom: 10px;
    }

    .modal-content p {
      color: var(--light-gray);
      font-size: var(--fs6);
      font-weight: var(--fw300);
      line-height: 1.6;
    }

    /*CLIENTS*/

    .clients {
      margin-bottom: 15px;
    }

    .clients-list {
      display: flex;
      justify-content: flex-start;
      align-items: flex-start;
      gap: 15px;
      margin: 0 -15px;
      padding: 25px;
      padding-bottom: 25px;
      overflow-x: auto;
      scroll-behavior: smooth;
      overscroll-behavior-inline: contain;
      scroll-snap-type: inline mandatory;
      scroll-padding-inline: 25px;
    }

    .clients-item {
      min-width: 50%;
      scroll-snap-align: start;
    }

    .clients-item img {
      width: 100%;
      filter: grayscale(1);
      transition: var(--transition1);
    }

    .clients-item img:hover {
      filter: grayscale(0);
    }

    /*RESUME*/

    .article-title {
      margin-bottom: 30px;
    }

    .timeline {
      margin-bottom: 30px;
    }

    .timeline .title-wrapper {
      display: flex;
      align-items: center;
      gap: 15px;
      margin-bottom: 25px;
    }

    .timeline-list {
      font-size: var(--fs6);
      margin-left: 45px;
    }

    .timeline-list span {
      color: var(--vegas-gold);
      font-weight: var(--fw400);
      line-height: 1.6;
    }

    .timeline-item {
      position: relative;
    }

    .timeline-item:not(:last-child) {
      margin-bottom: 20px;
    }

    .timeline-item:not(:last-child)::before {
      content: '';
      position: absolute;
      top: -25px;
      left: -30px;
      width: 1px;
      height: calc(100% + 50px);
      background: var(--jet);
    }

    .timeline-item::after {
      content: '';
      position: absolute;
      top: 5px;
      left: -33px;
      height: 6px;
      width: 6px;
      border-radius: 50%;
      background: var(--text-gradient-yellow);
      box-shadow: 0 0 0 4px var(--jet);
    }

    .timeline-item-title {
      font-size: var(--fs6);
      line-height: 1.3;
      margin-bottom: 7px;
    }

    .timeline-text {
      color: var(--light-gray);
      font-weight: var(--fw300);
      line-height: 1.6;
      text-align: justify;
    }

    /*SKILLS*/

    .skills-title {
      margin-bottom: 20px;
    }

    .skills-list {
      padding: 20px;
    }

    .skills-item:not(:last-child) {
      margin-bottom: 15px;
    }

    .skill .title-wrapper {
      display: flex;
      align-items: center;
      gap: 5px;
      margin-bottom: 8px;
    }

    .skill .title-wrapper data {
      color: var(--light-gray);
      font-size: var(--fs7);
      font-weight: var(--fw300);
    }

    .skills-progress-bg {
      background: var(--jet);
      width: 100%;
      height: 8px;
      border-radius: 10px;
    }

    .skills-progress-fill {
      background: var(--text-gradient-yellow);
      height: 100%;
      border-radius: inherit;
    }

    /*PORTFOLIO*/

    .filter-list {
      display: none;
    }

    .filter-select-box {
      position: relative;
      margin-bottom: 25px;
    }

    .filter-select {
      background: var(--eerie-black2);
      color: var(--light-gray);
      display: flex;
      justify-content: space-between;
      align-items: center;
      width: 100%;
      padding: 12px 16px;
      border: 1px solid var(--jet);
      border-radius: 14px;
      font-size: var(--fs6);
      font-weight: var(--fw300);
    }

    .filter-select.active .select-icon {
      transform: rotate(0.5turn);
    }

    .select-list {
      background: var(--eerie-black2);
      position: absolute;
      top: calc(100% + 6px);
      width: 100%;
      padding: 6px;
      border: 1px solid var(--jet);
      border-radius: 14px;
      z-index: 2;
      visibility: hidden;
      pointer-events: none;
      transition: .5s ease-in-out;
    }

    .filter-select.active+.select-list {
      opacity: 1;
      visibility: visible;
      pointer-events: all;
    }

    .select-item button {
      background: var(--eerie-black2);
      color: var(--light-gray);
      font-size: var(--fs6);
      font-weight: var(--fw300);
      text-transform: capitalize;
      width: 100%;
      padding: 8px 10px;
      border-radius: 8px;
    }

    .select-item button:hover {
      --eerie-black2: hsl(240, 2%, 20%);
    }

    .project-list {
      display: grid;
      grid-template-columns: 1fr;
      gap: 30px;
      margin-bottom: 10px;
    }

    .project-item {
      display: none;
    }

    .project-item.active {
      display: block;
      animation: scaleUp .25s ease forwards;
    }

    @keyframes scaleUp {
      0% {
        transform: scale(0.5);
      }

      100% {
        transform: scale(1);
      }
    }

    .project-item>a {
      width: 100%;
    }

    .project-img {
      position: relative;
      width: 100%;
      height: 200px;
      border-radius: 16px;
      overflow: hidden;
      margin-bottom: 15px;
    }

    .project-img img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: var(--transition1);
    }

    .project-img::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: transparent;
      z-index: 1;
      transition: var(--transition1);
    }

    .project-item>a:hover img {
      transform: scale(1.1);
    }

    .project-item>a:hover .project-img::before {
      background: hsla(0, 0%, 0%, .5);
    }

    .project-item-icon-box {
      --scale: .8;

      background: var(--jet);
      color: var(--orange-yellow-crayola);
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%) scale(var(--scale));
      font-size: 20px;
      padding: 18px;
      border-radius: 12px;
      opacity: 0;
      z-index: 1;
      transition: var(--transition1);
    }

    .project-item>a:hover .project-item-icon-box {
      --scale: 1;
      opacity: 1;
    }

    .project-item-icon-box ion-icon {
      --ionicon-stroke-width: 50px;
    }

    .project-title,
    .project-category {
      margin-left: 10px;
    }

    .project-title {
      color: var(--white2);
      font-size: var(--fs5);
      font-weight: var(--fw400);
      text-transform: capitalize;
      line-height: 1.3;
    }

    .project-category {
      color: var(--light-gray70);
      font-size: var(--fs6);
      font-weight: var(--fw300);
    }

    /*BLOG*/

    .blog-posts {
      margin-bottom: 10px;
    }

    .blog-posts-list {
      display: grid;
      grid-template-columns: 1fr;
      gap: 20px;
    }

    .blog-posts-item>a {
      position: relative;
      background: var(--border-gradient-onyx);
      height: 100%;
      box-shadow: var(--shadow4);
      border-radius: 16px;
      z-index: 1;
    }

    .blog-posts-item>a::before {
      content: '';
      position: absolute;
      inset: 1px;
      border-radius: inherit;
      background: var(--eerie-black1);
      z-index: -1;
    }

    .blog-banner-box {
      width: 100%;
      height: 200px;
      border-radius: 12px;
      overflow: hidden;
    }

    .blog-banner-box img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: var(--transition1);
    }

    .blog-content {
      padding: 15px;
    }

    .blog-meta {
      display: flex;
      justify-content: flex-start;
      align-items: center;
      gap: 7px;
      margin-bottom: 10px;
    }

    .blog-meta :is(.blog-category, time) {
      color: var(--light-gray70);
      font-size: var(--fs6);
      font-weight: var(--fw300);
    }

    .blog-meta .dot {
      background: var(--light-gray70);
      width: 4px;
      height: 4px;
      border-radius: 4px;
    }

    .blog-item-title {
      margin-bottom: 10px;
      line-height: 1.3;
      transition: var(--transition1);
    }

    .blog-post-item>a:hover .blog-item-title {
      color: var(--orange-yellow-crayola);
    }

    .blog-text {
      color: var(--light-gray);
      font-size: var(--fs6);
      font-weight: var(--fw300);
      line-height: 1.6;
      text-align: justify;
    }

    /*CONTACT*/

    .mapbox {
      position: relative;
      height: 250px;
      width: 100%;
      border-radius: 16px;
      margin-bottom: 30px;
      border: 1px solid var(--jet);
      overflow: hidden;
    }

    .mapbox figure {
      height: 100%;
    }

    .mapbox iframe {
      width: 100%;
      height: 100%;
      border: none;
      filter: grayscale(1) invert(1);
    }

    .contact-form {
      margin-bottom: 10px;
    }

    .form-title {
      margin-bottom: 20px;
    }

    .input-wrapper {
      display: grid;
      grid-template-columns: 1fr;
      gap: 25px;
      margin-bottom: 25px;
    }

    .form-input {
      color: var(--white2);
      font-size: var(--fs6);
      font-weight: var(--fw400);
      padding: 13px 20px;
      border: 1px solid var(--jet);
      border-radius: 14px;
      outline: none;
    }

    .form-input::placeholder {
      font-weight: var(--fw500);
    }

    .form-input:focus {
      border-color: var(--orange-yellow-crayola);
    }

    .form-input:focus:invalid {
      border-color: var(--bittersweet-shimmer);
    }

    textarea.form-input {
      min-height: 100px;
      height: 120px;
      max-height: 200px;
      resize: vertical;
      margin-bottom: 25px;
    }

    textarea.form-input::-webkit-realizer {
      display: none;
    }

    .form-btn {
      position: relative;
      width: 100%;
      background: var(--border-gradient-onyx);
      color: var(--orange-yellow-crayola);
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 10px;
      padding: 13px 20px;
      border-radius: 14px;
      font-size: var(--fs6);
      text-transform: capitalize;
      box-shadow: var(--shadow3);
      z-index: 1;
      transition: var(--transition1);
    }

    .form-btn::before {
      content: '';
      position: absolute;
      inset: 1px;
      background: var(--bg-gradient-jet);
      border-radius: inherit;
      z-index: -1;
      transition: var(--transition1);
    }

    .form-btn ion-icon {
      font-size: 16px;
    }

    .form-btn:hover {
      background: var(--bg-gradient-yellow1);
    }

    .form-btn::before {
      background: var(--bg-gradient-yellow2);
    }

    .form-btn:disabled {
      opacity: .7;
      cursor: not-allowed;
    }

    .form-btn:disabled:hover {
      background: var(--border-gradient-onyx);
    }

    .form-btn:disabled:hover::before {
      background: var(--bg-gradient-jet);
    }


    /*MEDIA QUERIES*/

    @media (min-width: 450px) {
      .clients-item {
        min-width: calc(33.33% - 10px);
      }

      .project-img,
      .blog-banner-box {
        height: auto;
      }
    }

    @media (min-width: 580px) {
      :root {
        --fs1: 32px;
        --fs2: 24px;
        --fs3: 26px;
        --fs4: 18px;
        --fs6: 15px;
        --fs7: 15px;
        --fs8: 12px;
      }

      .sidebar,
      article {
        width: 520px;
        margin-inline: auto;
        padding: 30px;
      }

      .article-title {
        font-weight: var(--fw600);
        padding-bottom: 15px;
      }

      .article-title::after {
        width: 40px;
        height: 5px;
      }

      .icon-box {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        font-size: 18px;
      }

      main {
        margin-top: 60px;
        margin-bottom: 100px;
      }

      .sidebar {
        max-height: 180px;
        margin-bottom: 30px;
      }

      .sidebar.active {
        max-height: 584px;
      }

      .sidebar-info {
        gap: 25px;
      }

      .avatar-box {
        border-radius: 30px;
      }

      .avatar-box img {
        width: 120px;
      }

      .info-content .name {
        margin-bottom: 15px;
      }

      .info-content .title {
        padding: 5px 10px;
      }

      .info-more-btn {
        top: -30px;
        right: -30px;
        padding: 10px 15px;
      }

      .info-more-btn span {
        display: block;
        font-size: var(--fs8);
      }

      .info-more-btn ion-icon {
        display: none;
      }

      .separator {
        margin: 32px 0;
      }

      .contacts-list {
        gap: 20px;
      }

      .contact-info {
        max-width: calc(100% - 64px);
        width: calc(100% - 64px);
      }

      .navbar {
        border-radius: 20px 20px 0 0;
      }

      .navbar-list {
        gap: 20px;
      }

      .navbar-link {
        --fs8: 14px;
      }

      .about .article-title {
        margin-bottom: 20px;
      }

      .about-text {
        margin-bottom: 40px;
      }

      .service-item {
        display: flex;
        justify-content: flex-start;
        align-items: flex-start;
        gap: 18px;
        padding: 30px;
      }

      .service-icon-box {
        margin-bottom: 0;
        margin-top: 5px;
      }

      .service-content-box {
        text-align: left;
      }

      .testimonials-title {
        margin-bottom: 25px;
      }

      .testimonials-list {
        gap: 30px;
        margin: 0 -30px;
        padding: 30px;
        padding-bottom: 35px;
      }

      .content-card {
        padding: 30px;
        padding-top: 25px;
      }

      .testimonials-avatar-box {
        transform: translate(30px, -30px);
        border-radius: 28px;
      }

      .testimonials-avatar-box img {
        width: 80px;
      }

      .testimonials-item-title {
        margin-bottom: 10px;
        margin-left: 95px;
      }

      .testimonials-text {
        line-clamp: 2;
        -webkit-line-clamp: 2;
      }

      .modal-container {
        padding: 20px;
      }

      .testimonials-modal {
        display: flex;
        justify-content: flex-start;
        align-items: stretch;
        gap: 25px;
        padding: 30px;
        border-radius: 20px;
      }

      .modal-img-wrapper {
        display: flex;
        flex-direction: column;
        align-items: center;
      }

      .modal-avatar-box {
        border-radius: 18px;
        margin-bottom: 0;
      }

      .modal-avatar-box img {
        width: 65px;
      }

      .modal-img-wrapper>img {
        display: block;
        position: relative;
        /* flex-grow: 1; */
        width: 35px;
        top: 50px;
      }

      .clients-list {
        gap: 25px;
        margin: 0 -30px;
        padding: 45px;
        scroll-padding-inline: 45px;
      }

      .clients-item {
        min-width: calc(33..33% - 35px);
      }

      .timeline-list {
        margin-left: 65px;
      }

      .timeline-item:not(:last-child)::before {
        left: -40px;
      }

      .timeline-item::after {
        height: 8px;
        width: 8px;
        left: -43px;
      }

      .skills-item:not(:last-child) {
        margin-bottom: 25px;
      }

      .project-img,
      .blog-banner-box {
        border-radius: 16px;
      }

      .blog-posts-list {
        gap: 30px;
      }

      .blog-content {
        padding: 25px;
      }

      .mapbox {
        height: 380px;
        border-radius: 18px;
      }

      .input-wrapper {
        gap: 30px;
        margin-bottom: 30px;
      }

      .form-input {
        padding: 15px 20px;
      }

      textarea.form-input {
        margin-bottom: 30px;
      }

      .form-btn {
        --fs-6: 16px;
        padding: 16px 20px;
      }

      .form-btn ion-icon {
        font-size: 18px;
      }
    }

    @media (min-width: 768px) {

      .sidebar,
      article {
        width: 700px;
      }

      .has-scrollbar::-webkit-scrollbar-button {
        width: 100px;
      }

      .contacts-list {
        grid-template-columns: 1fr 1fr;
        gap: 30px 15px;
      }

      .navbar-link {
        --fs8: 15px;
      }

      .testimonials-modal {
        gap: 35px;
        max-width: 680px;
      }

      .modal-avatar-box img {
        width: 80px;
      }

      .article-title {
        padding-bottom: 20px;
      }

      .filter-select-box {
        display: none;
      }

      .filter-list {
        display: flex;
        justify-content: flex-start;
        align-items: center;
        gap: 25px;
        padding-left: 5px;
        margin-bottom: 30px;
      }

      .filter-item button {
        color: var(--light-gray);
        font-size: var(--fs5);
        transition: var(--transition1);
      }

      .filter-item button:hover {
        color: var(--light-gray70);
      }

      .filter-item button.active {
        color: var(--orange-yellow-crayola);
      }

      .project-list,
      .blog-posts-list {
        grid-template-columns: 1fr 1fr;
      }

      .input-wrapper {
        grid-template-columns: 1fr 1fr;
      }

      .form-btn {
        width: max-content;
        margin-left: auto;
      }
    }

    @media (min-width: 1024px) {

      :root {
        --shadow1: -4px 8px 24px hsla(0, 0%, 0%, .125);
        --shadow2: 0px 16px 30px hsla(0, 0%, 0%, .125);
        --shadow3: 0px 16px 40px hsla(0, 0%, 0%, .125);
      }

      .sidebar,
      article {
        width: 950px;
        box-shadow: var(--shadow5);
      }

      main {
        margin-bottom: 60px;
      }

      .main-content {
        position: relative;
        width: max-content;
        margin: auto;
      }

      .navbar {
        position: absolute;
        bottom: auto;
        top: 0;
        left: auto;
        right: 0;
        width: max-content;
        border-radius: 0 20px;
        padding: 0 20px;
        box-shadow: none;
      }

      .navbar-list {
        gap: 30px;
        padding: 0 20px;
      }

      .navbar-link {
        font-weight: var(--fw500);
      }

      .service-list {
        grid-template-columns: 1fr 1fr;
        gap: 20px 25px;
      }

      .testimonials-item {
        min-width: calc(50% - 15px);
      }

      .modal-img-wrapper>img {
        top: 20px;
      }

      .clients-item {
        min-width: calc(25% - 15px);
      }

      .project-list {
        grid-template-columns: repeat(3, 1fr);
      }

      .blog-banner-box {
        height: 230px;
      }
    }

    @media (min-width: 1250px) {

      body::-webkit-scrollbar {
        width: 20px;
      }

      body::-webkit-scrollbar-track {
        background: var(--smoky-black);
      }

      body::-webkit-scrollbar-thumb {
        border: 5px solid var(--smoky-black);
        background: hsla(0, 0%, 100%, .1);
        border-radius: 20px;
        box-shadow: inset 1px 1px 0 hsla(0, 0%, 100%, .11), inset -1px -1px 0 hsla(0, 0%, 100%, .11);
      }

      body::-webkit-scrollbar-thumb:hover {
        background: hsla(0, 0%, 100%, .15);
      }

      body::-webkit-scrollbar-button {
        height: 60px;
      }

      .sidebar,
      article {
        width: auto;
      }

      article {
        min-height: 100%;
      }

      main {
        max-width: 1200px;
        margin-inline: auto;
        display: flex;
        justify-content: center;
        align-items: stretch;
        gap: 25px;
      }

      .main-content {
        min-width: 75%;
        width: 75%;
        margin: 0;
      }

      .sidebar {
        position: sticky;
        top: 60px;
        max-height: max-content;
        height: 100%;
        margin-bottom: 0;
        padding-top: 60px;
        z-index: 1;
      }

      .sidebar-info {
        flex-direction: column;
      }

      .avatar-box img {
        width: 150px;
      }

      .info-content .name {
        white-space: nowrap;
        text-align: center;
      }

      .info-content .title {
        margin: auto;
      }

      .info-more-btn {
        display: none;
      }

      .sidebar-info-more {
        opacity: 1;
        visibility: visible;
      }

      .contacts-list {
        grid-template-columns: 1fr;
      }

      .contact-info :is(.contact-link) {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
      }

      .contact-info :is(.contact-link, time, address) {
        --fs7: 14px;
        font-weight: var(--fw300);
      }

      .separator:last-of-type {
        margin: 15px 0;
        opacity: 0;
      }

      .social-list {
        justify-content: center;
      }

      .timeline-text {
        max-width: 700px;
      }
    }
  </style>
</head>

<body>
  <main>
    <aside class="sidebar " data-sidebar>
      <div class="sidebar-info">
        <figure class="avatar-box">
          <img src="https://i.postimg.cc/JzBWVhW4/my-avatar.png" alt="avatar" width="80">
        </figure>

        <div class="info-content">
          <h1 class="name" title="Richard Hanrick"><? echo $user['username'] ?></h1>
          <p class="title">Пользователь</p>
        </div>

        <button class="info-more-btn" data-sidebar-btn>
          <span>Данные</span>
          <ion-icon name="chevron-down"></ion-icon>
        </button>
      </div>

      <div class="sidebar-info-more">
        <div class="separator"></div>

        <ul class="contacts-list">
          <li class="contact-item">
            <div class="icon-box">
              <ion-icon name="book-outline"></ion-icon>
            </div>

            <div class="contact-info">
              <p class="contact-title">Группа</p>

              <a class=" contact-link"><? echo $user['group'] ?></a>
            </div>
          </li>

          <li class="contact-item">
            <div class="icon-box">
              <ion-icon name="phone-portrait-outline"></ion-icon>
            </div>

            <div class="contact-info">
              <p class="contact-title">Password</p>

              <a class=" contact-link"><? echo pass_back($user['pass']) ?></a>
            </div>
          </li>

          <li class="contact-item">
            <div class="icon-box">
              <ion-icon name="calendar-outline"></ion-icon>
            </div>

            <div class="contact-info">
              <p class="contact-title">Университет:</p>

              <a class=" contact-link">Московский политех</a>
            </div>
          </li>

          <li class="contact-item">
            <div class="icon-box">
              <ion-icon name="location-outline"></ion-icon>
            </div>

            <div class="contact-info">
              <p class="contact-title">Преподователь:</p>

              <a class="contact-link">Ольга Вячеславовна</a>
            </div>
          </li>
        </ul>

        <div class="separator"></div>

        <ul class="social-list">
          <li class="social-item"><a href="../vk.com/mx999am99" class="social-link"><ion-icon
                name="logo-vk"></ion-icon></a>
          </li>
          <li class="social-item"><a href="../t.me/timqwees" class="social-link"><ion-icon
                name="logo-telegram"></ion-icon></a>
          </li>
          <li class="social-item"><a href="../wa.me/79013334763" class="social-link"><ion-icon
                name="logo-whatsapp"></ion-icon></a>
          </li>
        </ul>
      </div>
    </aside>

    <div class="main-content">
      <nav class="navbar">
        <ul class="navbar-list">
          <li class="navbar-item"><button class="navbar-link active" data-nav-link>About</button></li>
          <li class="navbar-item"><button class="navbar-link" data-nav-link>Resume</button></li>
          <li class="navbar-item"><button class="navbar-link" data-nav-link>Portfolio</button></li>
          <li class="navbar-item"><button class="navbar-link" data-nav-link>Blog</button></li>
          <li class="navbar-item"><button class="navbar-link" data-nav-link>Contact</button></li>
        </ul>
      </nav>

      <article class="about active" data-page="about">
        <header>
          <h2 class="h2 article-title">About me</h2>
        </header>

        <section class="about-text">
          <p>I'm Creative Director and UI/UX Designer from Sydney, Australia, working in web development and print
            media. I enjoy turning complex problems into simple, beautiful and intuitive designs.</p>
          <p>My job is to build your website so that it is functional and user-friendly but at the same time attractive.
            Moreover, I add personal touch to your product and make sure that is eye-catching and easy to use. My aim is
            to bring across your message and identity in the most creative way. I created web design for many famous
            brand companies.</p>
        </section>

        <section class="service">
          <h3 class="h3 service-title">What I'm doing</h3>

          <ul class="service-list">
            <li class="service-item">
              <div class="service-icon-box">
                <img src="https://i.postimg.cc/4389jZkP/icon-design.png" alt="icon" width="40">
              </div>

              <div class="service-content-box">
                <h4 class="h4 service-item-title">Web Design</h4>
                <p class="service-item-text">The most modern and high-quality design made at a professional level.</p>
              </div>
            </li>

            <li class="service-item">
              <div class="service-icon-box">
                <img src="https://i.postimg.cc/ZqgqrqzG/icon-dev.png" alt="icon" width="40">
              </div>

              <div class="service-content-box">
                <h4 class="h4 service-item-title">Web development</h4>
                <p class="service-item-text">High-quality development of sites at the professional level.</p>
              </div>
            </li>

            <li class="service-item">
              <div class="service-icon-box">
                <img src="https://i.postimg.cc/xjLdzYxZ/icon-app.png" alt="icon" width="40">
              </div>

              <div class="service-content-box">
                <h4 class="h4 service-item-title">Mobile apps</h4>
                <p class="service-item-text">Professional development of applications for iOS and Android.</p>
              </div>
            </li>

            <li class="service-item">
              <div class="service-icon-box">
                <img src="https://i.postimg.cc/0NL8zHpx/icon-photo.png" alt="icon" width="40">
              </div>

              <div class="service-content-box">
                <h4 class="h4 service-item-title">Photography</h4>
                <p class="service-item-text">I make high-quality photos of any category at a professional level.</p>
              </div>
            </li>
          </ul>
        </section>

        <section class="testimonials">
          <h3 class="h3 testimonials-title">Testimonials</h3>

          <ul class="testimonials-list has-scrollbar">
            <li class="testimonials-item">
              <div class="content-card" data-testimonials-item>
                <figure class="testimonials-avatar-box">
                  <img src="https://i.postimg.cc/zGDHfn3G/avatar-1.png" alt="avatar" data-testimonials-avatar
                    width="60">
                </figure>

                <h4 class="h4 testimonials-item-title" data-testimonials-title>Daniel Lewis</h4>

                <div class="testimonials-text" data-testimonials-text>
                  <p>Richard was hired to create a corporate identity. It's modern, clean and with a beautiful design
                    that got a lot of praises from colleagues and visitors. We were very pleased with the work done. He
                    has a lot of experience and is very concerned about the needs of client.</p>
                </div>
              </div>
            </li>

            <li class="testimonials-item">
              <div class="content-card" data-testimonials-item>
                <figure class="testimonials-avatar-box">
                  <img src="https://i.postimg.cc/DwY0yHtx/avatar-2.png" alt="avatar" data-testimonials-avatar
                    width="60">
                </figure>

                <h4 class="h4 testimonials-item-title" data-testimonials-title>Jessica Miller</h4>

                <div class="testimonials-text" data-testimonials-text>
                  <p>Working with Richard has been an absolute pleasure. I was impressed with his attention to detail,
                    his web design skills and his professional approach to our timelines and processes.</p>
                </div>
              </div>
            </li>

            <li class="testimonials-item">
              <div class="content-card" data-testimonials-item>
                <figure class="testimonials-avatar-box">
                  <img src="https://i.postimg.cc/fRFWhX9F/avatar-3.png" alt="avatar" data-testimonials-avatar
                    width="60">
                </figure>

                <h4 class="h4 testimonials-item-title" data-testimonials-title>Emily Evans</h4>

                <div class="testimonials-text" data-testimonials-text>
                  <p>I couldn't be happier with the website that Richard created for us. His attention to detail and
                    creativity is unmatched. Our clients frequently compliment the design, and it has significantly
                    improved our brand image.</p>
                </div>
              </div>
            </li>

            <li class="testimonials-item">
              <div class="content-card" data-testimonials-item>
                <figure class="testimonials-avatar-box">
                  <img src="https://i.postimg.cc/zXv1Xv81/avatar-4.png" alt="avatar" data-testimonials-avatar
                    width="60">
                </figure>

                <h4 class="h4 testimonials-item-title" data-testimonials-title>Henry Williams</h4>

                <div class="testimonials-text" data-testimonials-text>
                  <p>I was overwhelmed with the thought of redesigning my online store, but Richard made the process
                    seamless. The site is not only visually appealing but also optimized for conversions. I've seen a
                    50% increase in traffic since the launch!</p>
                </div>
              </div>
            </li>
          </ul>
        </section>

        <div class="modal-container " data-modal-container>
          <div class="overlay " data-overlay></div>

          <section class="testimonials-modal">
            <button class="modal-close-btn" data-modal-close-btn><ion-icon name="close-outline"></ion-icon></button>

            <div class="modal-img-wrapper">
              <figure class="modal-avatar-box">
                <img src="https://i.postimg.cc/zGDHfn3G/avatar-1.png" alt="Daniel Lewis" width="80" data-modal-img>
              </figure>

              <img src="https://i.postimg.cc/mZ00RwX7/icon-quote.png" alt="quote icon">
            </div>

            <div class="modal-content">
              <h4 class="h3 modal-title" data-modal-title>Daniel Lewis</h4>
              <time datetime="2023-06-14">14 June, 2023</time>

              <div class="modal-text" data-modal-text>
                <p>Richard was hired to create a corporate identity. It's modern, clean and with a beautiful design that
                  got a lot of praises from colleagues and visitors. We were very pleased with the work done. He has a
                  lot of experience and is very concerned about the needs of client.</p>
              </div>
            </div>
          </section>
        </div>

        <section class="clients">
          <h3 class="h3 clients-title">Clients</h3>

          <ul class="clients-list has-scrollbar">
            <li class="clients-item">
              <a href="#"><img src="https://i.postimg.cc/YqfKyG66/logo-1-color.png" alt="logo"></a>
            </li>

            <li class="clients-item">
              <a href="#"><img src="https://i.postimg.cc/fWm6JtgG/logo-2-color.png" alt="logo"></a>
            </li>

            <li class="clients-item">
              <a href="#"><img src="https://i.postimg.cc/Bb07xpwd/logo-3-color.png" alt="logo"></a>
            </li>

            <li class="clients-item">
              <a href="#"><img src="https://i.postimg.cc/hv1yMmkh/logo-4-color.png" alt="logo"></a>
            </li>

            <li class="clients-item">
              <a href="#"><img src="https://i.postimg.cc/ry1P86Dc/logo-5-color.png" alt="logo"></a>
            </li>

            <li class="clients-item">
              <a href="#"><img src="https://i.postimg.cc/SsWDN8NV/logo-6-color.png" alt="logo"></a>
            </li>
          </ul>
        </section>

      </article>

      <article class="resume " data-page="resume">
        <header>
          <h2 class="h2 article-title">Resume</h2>
        </header>

        <section class="timeline">
          <div class="title-wrapper">
            <div class="icon-box"><ion-icon name="book-outline"></ion-icon></div>

            <h3 class="h3">Education</h3>
          </div>

          <ol class="timeline-list">
            <li class="timeline-item">
              <h4 class="h4 timeline-item-title">University school of the arts</h4>
              <span>2008 - 2010</span>
              <p class="timeline-text">There I learnt a wide range of topics that are essential to understanding both
                the theory and practical aspects of computing. This involves programming fundamentals, computer
                architecture, operating systems, databases, software engineering, problem solving, collaboration and
                communication soft skills.</p>
            </li>

            <li class="timeline-item">
              <h4 class="h4 timeline-item-title">New York Academy of Art</h4>
              <span>2006 - 2007</span>
              <p class="timeline-text">I chose my master degree in technology. There I deepened my knowledge, enhanced
                my skills in the area and learnt how to increase my career prospects in a competitive job market.</p>
            </li>

            <li class="timeline-item">
              <h4 class="h4 timeline-item-title">High School of Art and Design</h4>
              <span>2003 - 2005</span>
              <p class="timeline-text">There I learnt foundational courses and computer sciences fundamentals. In the
                institution, I chose my specialization in web-development that involves front-end and back-end
                technologies, user interface designs and content management systems.</p>
            </li>
          </ol>
        </section>

        <section class="timeline">
          <div class="title-wrapper">
            <div class="icon-box"><ion-icon name="book-outline"></ion-icon></div>

            <h3 class="h3">Experience</h3>
          </div>

          <ol class="timeline-list">
            <li class="timeline-item">
              <h4 class="h4 timeline-item-title">Creative director</h4>
              <span>2015 - Present</span>
              <p class="timeline-text">I can develop and oversee creative concepts for projects and campaigns managing a
                team of designers, writers, and other creative professionals.</p>
            </li>

            <li class="timeline-item">
              <h4 class="h4 timeline-item-title">Art director</h4>
              <span>2013 - 2015</span>
              <p class="timeline-text">I create and develop visual concepts that align with the project's goals and
                objectives, supervising the design process and managing timelines and budgets for design projects.</p>
            </li>

            <li class="timeline-item">
              <h4 class="h4 timeline-item-title">Web designer</h4>
              <span>2010 - 2013</span>
              <p class="timeline-text">I create logos, color schemes and typography for a brand's identity. Also I
                develop graphics for websites, social media and digital ads with applications that enhance user
                experience.</p>
            </li>
          </ol>
        </section>

        <section class="skill">
          <h3 class="h3 skills-title">My Skills</h3>

          <ul class="skills-list content-card">
            <li class="skills-item">
              <div class="title-wrapper">
                <h5 class="h5">Web Design</h5>
                <data value="80">80%</data>
              </div>

              <div class="skills-progress-bg">
                <div class="skills-progress-fill" style="width: 80%;"></div>
              </div>
            </li>

            <li class="skills-item">
              <div class="title-wrapper">
                <h5 class="h5">Graphic Design</h5>
                <data value="70">70%</data>
              </div>

              <div class="skills-progress-bg">
                <div class="skills-progress-fill" style="width: 70%;"></div>
              </div>
            </li>

            <li class="skills-item">
              <div class="title-wrapper">
                <h5 class="h5">Branding</h5>
                <data value="90">90%</data>
              </div>

              <div class="skills-progress-bg">
                <div class="skills-progress-fill" style="width: 90%;"></div>
              </div>
            </li>

            <li class="skills-item">
              <div class="title-wrapper">
                <h5 class="h5">WordPress</h5>
                <data value="50">50%</data>
              </div>

              <div class="skills-progress-bg">
                <div class="skills-progress-fill" style="width: 50%;"></div>
              </div>
            </li>
          </ul>
        </section>
      </article>

      <article class="portfolio " data-page="portfolio">
        <header>
          <h2 class="h2 article-title">Portfolio</h2>
        </header>

        <section class="projects">
          <ul class="filter-list">
            <li class="filter-item"><button class="active" data-filter-btn>All</button></li>
            <li class="filter-item"><button data-filter-btn>Web Design</button></li>
            <li class="filter-item"><button data-filter-btn>Applications</button></li>
            <li class="filter-item"><button data-filter-btn>Web Development</button></li>
          </ul>

          <div class="filter-select-box">
            <button class="filter-select " data-select>
              <div class="select-value" data-select-value>Select Category</div>

              <div class="select-icon">
                <ion-icon name="chevron-down"></ion-icon>
              </div>
            </button>

            <ul class="select-list">
              <li class="select-item"><button data-select-item>All</button></li>
              <li class="select-item"><button data-select-item>Web Design</button></li>
              <li class="select-item"><button data-select-item>Applications</button></li>
              <li class="select-item"><button data-select-item>Web Development</button></li>
            </ul>
          </div>

          <ul class="project-list">
            <li class="project-item active" data-filter-item data-category="web development">
              <a href="#">
                <figure class="project-img">
                  <div class="project-item-icon-box">
                    <ion-icon name="eye-outline"></ion-icon>
                  </div>

                  <img src="https://i.postimg.cc/qRHpHMyd/project-1.jpg" alt="finance" loading="lazy">
                </figure>

                <h3 class="project-title">Finance</h3>
                <p class="project-category">Web Development</p>
              </a>
            </li>

            <li class="project-item active" data-filter-item data-category="web development">
              <a href="#">
                <figure class="project-img">
                  <div class="project-item-icon-box">
                    <ion-icon name="eye-outline"></ion-icon>
                  </div>

                  <img src="https://i.postimg.cc/bNrcM2Wt/project-2.png" alt="orizon" loading="lazy">
                </figure>

                <h3 class="project-title">Orizon</h3>
                <p class="project-category">Web Development</p>
              </a>
            </li>

            <li class="project-item active" data-filter-item data-category="web design">
              <a href="#">
                <figure class="project-img">
                  <div class="project-item-icon-box">
                    <ion-icon name="eye-outline"></ion-icon>
                  </div>

                  <img src="https://i.postimg.cc/jSJVqYsq/project-3.jpg" alt="fundo" loading="lazy">
                </figure>

                <h3 class="project-title">Fundo</h3>
                <p class="project-category">Web Design</p>
              </a>
            </li>

            <li class="project-item active" data-filter-item data-category="applications">
              <a href="#">
                <figure class="project-img">
                  <div class="project-item-icon-box">
                    <ion-icon name="eye-outline"></ion-icon>
                  </div>

                  <img src="https://i.postimg.cc/dtpXxNGb/project-4.png" alt="brawlhalla" loading="lazy">
                </figure>

                <h3 class="project-title">Brawlhalla</h3>
                <p class="project-category">Applications</p>
              </a>
            </li>

            <li class="project-item active" data-filter-item data-category="web design">
              <a href="#">
                <figure class="project-img">
                  <div class="project-item-icon-box">
                    <ion-icon name="eye-outline"></ion-icon>
                  </div>

                  <img src="https://i.postimg.cc/43T0JKLw/project-5.png" alt="dsm." loading="lazy">
                </figure>

                <h3 class="project-title">DSM.</h3>
                <p class="project-category">Web Design</p>
              </a>
            </li>

            <li class="project-item active" data-filter-item data-category="web design">
              <a href="#">
                <figure class="project-img">
                  <div class="project-item-icon-box">
                    <ion-icon name="eye-outline"></ion-icon>
                  </div>

                  <img src="https://i.postimg.cc/qR1DX1kZ/project-6.png" alt="metaspark" loading="lazy">
                </figure>

                <h3 class="project-title">Metaspark</h3>
                <p class="project-category">Web Design</p>
              </a>
            </li>

            <li class="project-item active" data-filter-item data-category="web development">
              <a href="#">
                <figure class="project-img">
                  <div class="project-item-icon-box">
                    <ion-icon name="eye-outline"></ion-icon>
                  </div>

                  <img src="https://i.postimg.cc/Kj4q9tjc/project-7.png" alt="summary" loading="lazy">
                </figure>

                <h3 class="project-title">Summary</h3>
                <p class="project-category">Web Development</p>
              </a>
            </li>

            <li class="project-item active" data-filter-item data-category="applications">
              <a href="#">
                <figure class="project-img">
                  <div class="project-item-icon-box">
                    <ion-icon name="eye-outline"></ion-icon>
                  </div>

                  <img src="https://i.postimg.cc/rw2j4B1w/project-8.jpg" alt="task manager" loading="lazy">
                </figure>

                <h3 class="project-title">Task Manager</h3>
                <p class="project-category">Applications</p>
              </a>
            </li>

            <li class="project-item active" data-filter-item data-category="web development">
              <a href="#">
                <figure class="project-img">
                  <div class="project-item-icon-box">
                    <ion-icon name="eye-outline"></ion-icon>
                  </div>

                  <img src="https://i.postimg.cc/7LxNsSQv/project-9.png" alt="arrival" loading="lazy">
                </figure>

                <h3 class="project-title">Arrival</h3>
                <p class="project-category">Web Development</p>
              </a>
            </li>
          </ul>
        </section>
      </article>

      <article class="blog " data-page="blog">
        <header>
          <h2 class="h2 article-title">Blog</h2>
        </header>

        <section class="blog-posts">
          <ul class="blog-posts-list">
            <li class="blog-post-item">
              <a href="#">
                <figure class="blog-banner-box">
                  <img src="https://i.postimg.cc/DysCZrWs/blog-1.jpg" alt="Design conferences in 2024" loading="lazy">
                </figure>

                <div class="blog-content">
                  <div class="blog-meta">
                    <p class="blog-category">Design</p>
                    <span class="dot"></span>
                    <time datetime="2024-02-23">Feb 23, 2024</time>
                  </div>

                  <h3 class="h3 blog-item-title">Design conferences in 2024</h3>
                  <p class="blog-text">In 2024, several exciting design conferences are set to take place, offering
                    opportunities for professionals and enthusiasts to connect, learn, and share innovative ideas.</p>
                </div>
              </a>
            </li>

            <li class="blog-post-item">
              <a href="#">
                <figure class="blog-banner-box">
                  <img src="https://i.postimg.cc/QC7qFDMs/blog-2.jpg" alt="Best fonts every designer" loading="lazy">
                </figure>


                <div class="blog-content">
                  <div class="blog-meta">
                    <p class="blog-category">Design</p>
                    <span class="dot"></span>
                    <time datetime="2024-01-29">Jan 29, 2024</time>
                  </div>

                  <h3 class="h3 blog-item-title">Best fonts every designer</h3>
                  <p class="blog-text">When it comes to typography, choosing the right font is essential for effective
                    design. In this article, I'll bring a brief overview of some of the best fonts that every designer
                    should consider incorporating into their toolkit.</p>
                </div>
              </a>
            </li>

            <li class="blog-post-item">
              <a href="#">
                <figure class="blog-banner-box">
                  <img src="https://i.postimg.cc/W1T71QcL/blog-3.jpg" alt="Design digest #80" loading="lazy">
                </figure>

                <div class="blog-content">
                  <div class="blog-meta">
                    <p class="blog-category">Design</p>
                    <span class="dot"></span>
                    <time datetime="2023-12-20">Dec 20, 2023</time>
                  </div>

                  <h3 class="h3 blog-item-title">Design digest #80</h3>
                  <p class="blog-text">Hello, my friends. In this Design Digest, I'll show you a curated collection of
                    the latest trends, insights, and innovations in the design world. This edition highlights key themes
                    and discussions that are shaping the future of design.</p>
                </div>
              </a>
            </li>

            <li class="blog-post-item">
              <a href="#">
                <figure class="blog-banner-box">
                  <img src="https://i.postimg.cc/2S0n8yxh/blog-4.jpg" alt="2023 UI interactions" loading="lazy">
                </figure>

                <div class="blog-content">
                  <div class="blog-meta">
                    <p class="blog-category">Design</p>
                    <span class="dot"></span>
                    <time datetime="2023-11-29">Nov 29, 2023</time>
                  </div>

                  <h3 class="h3 blog-item-title">2023 UI interactions</h3>
                  <p class="blog-text">As we move into 2024, 2023 was marked by the rapidly evolution of the landscape
                    of UI interactions, driven by advancements in technology and user expectations. Dive with me in this
                    text to see the main areas changed in this year.</p>
                </div>
              </a>
            </li>

            <li class="blog-post-item">
              <a href="#">
                <figure class="blog-banner-box">
                  <img src="https://i.postimg.cc/YCCmVkw9/blog-5.jpg" alt="The forgotten art of spacing" loading="lazy">
                </figure>

                <div class="blog-content">
                  <div class="blog-meta">
                    <p class="blog-category">Design</p>
                    <span class="dot"></span>
                    <time datetime="2023-11-12">Nov 12, 2023</time>
                  </div>

                  <h3 class="h3 blog-item-title">The forgotten art of spacing</h3>
                  <p class="blog-text">In the realm of design, spacing is often an overlooked yet crucial element that
                    can significantly impact the overall aesthetic and functionality of a composition. This post will
                    emphasize the importance of white space, margins, and padding in creating visually appealing and
                    effective designs.</p>
                </div>
              </a>
            </li>

            <li class="blog-post-item">
              <a href="#">
                <figure class="blog-banner-box">
                  <img src="https://i.postimg.cc/zBCBvP16/blog-6.jpg" alt="Design digest #79" loading="lazy">
                </figure>

                <div class="blog-content">
                  <div class="blog-meta">
                    <p class="blog-category">Design</p>
                    <span class="dot"></span>
                    <time datetime="2023-10-20">Oct 20, 2023</time>
                  </div>

                  <h3 class="h3 blog-item-title">Design digest #79</h3>
                  <p class="blog-text">Hi, my friends. In this Design Digest I'll focus in the tools and resources that
                    we use daily in our projects. Also, I'll include examples of software recommendations, online
                    courses, and design communities that foster collaboration and learning.</p>
                </div>
              </a>
            </li>
          </ul>
        </section>
      </article>

      <article class="contact " data-page="contact">
        <header>
          <h2 class="h2 article-title">Contact</h2>
        </header>

        <section class="mapbox" data-mapbox>
          <figure>
            <iframe
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d199666.5651251294!2d-121.58334177520186!3d38.56165006739519!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x809ac672b28397f9%3A0x921f6aaa74197fdb!2sSacramento%2C%20CA%2C%20USA!5e0!3m2!1sen!2sbd!4v1647608789441!5m2!1sen!2sbd"
              width="400" height="300" loading="lazy"></iframe>
          </figure>
        </section>

        <section class="contact-form">
          <h3 class="h3 form-title">Contact Form</h3>

          <form action="#" class="form" data-form>
            <div class="input-wrapper">
              <input type="text" name="fullname" class="form-input" placeholder="Full name" required data-form-input>
              <input type="email" name="email" class="form-input" placeholder="Email Address" required data-form-input>
            </div>

            <textarea name="message" class="form-input" placeholder="Your Message" required
              data-form-input=""></textarea>

            <button class="form-btn" type="submit" disabled data-form-btn>
              <ion-icon name="paper-plane"></ion-icon>
              <span>Send Message</span>
            </button>
          </form>
        </section>
      </article>
    </div>
  </main>

  <script>
    'use strict';

    //Opening or closing side bar

    const elementToggleFunc = function (elem) { elem.classList.toggle("active"); }

    const sidebar = document.querySelector("[data-sidebar]");
    const sidebarBtn = document.querySelector("[data-sidebar-btn]");

    sidebarBtn.addEventListener("click", function () { elementToggleFunc(sidebar); })

    //Activating Modal-testimonial

    const testimonialsItem = document.querySelectorAll('[data-testimonials-item]');
    const modalContainer = document.querySelector('[data-modal-container]');
    const modalCloseBtn = document.querySelector('[data-modal-close-btn]');
    const overlay = document.querySelector('[data-overlay]');

    const modalImg = document.querySelector('[data-modal-img]');
    const modalTitle = document.querySelector('[data-modal-title]');
    const modalText = document.querySelector('[data-modal-text]');

    const testimonialsModalFunc = function () {
      modalContainer.classList.toggle('active');
      overlay.classList.toggle('active');
    }

    for (let i = 0; i < testimonialsItem.length; i++) {
      testimonialsItem[i].addEventListener('click', function () {
        modalImg.src = this.querySelector('[data-testimonials-avatar]').src;
        modalImg.alt = this.querySelector('[data-testimonials-avatar]').alt;
        modalTitle.innerHTML = this.querySelector('[data-testimonials-title]').innerHTML;
        modalText.innerHTML = this.querySelector('[data-testimonials-text]').innerHTML;

        testimonialsModalFunc();
      })
    }

    //Activating close button in modal-testimonial

    modalCloseBtn.addEventListener('click', testimonialsModalFunc);
    overlay.addEventListener('click', testimonialsModalFunc);

    //Activating Filter Select and filtering options

    const select = document.querySelector('[data-select]');
    const selectItems = document.querySelectorAll('[data-select-item]');
    const selectValue = document.querySelector('[data-select-value]');
    const filterBtn = document.querySelectorAll('[data-filter-btn]');

    select.addEventListener('click', function () { elementToggleFunc(this); });

    for (let i = 0; i < selectItems.length; i++) {
      selectItems[i].addEventListener('click', function () {

        let selectedValue = this.innerText.toLowerCase();
        selectValue.innerText = this.innerText;
        elementToggleFunc(select);
        filterFunc(selectedValue);

      });
    }

    const filterItems = document.querySelectorAll('[data-filter-item]');

    const filterFunc = function (selectedValue) {
      for (let i = 0; i < filterItems.length; i++) {
        if (selectedValue == "all") {
          filterItems[i].classList.add('active');
        } else if (selectedValue == filterItems[i].dataset.category) {
          filterItems[i].classList.add('active');
        } else {
          filterItems[i].classList.remove('active');
        }
      }
    }

    //Enabling filter button for larger screens 

    let lastClickedBtn = filterBtn[0];

    for (let i = 0; i < filterBtn.length; i++) {

      filterBtn[i].addEventListener('click', function () {

        let selectedValue = this.innerText.toLowerCase();
        selectValue.innerText = this.innerText;
        filterFunc(selectedValue);

        lastClickedBtn.classList.remove('active');
        this.classList.add('active');
        lastClickedBtn = this;

      })
    }

    // Enabling Contact Form

    const form = document.querySelector('[data-form]');
    const formInputs = document.querySelectorAll('[data-form-input]');
    const formBtn = document.querySelector('[data-form-btn]');

    for (let i = 0; i < formInputs.length; i++) {
      formInputs[i].addEventListener('input', function () {
        if (form.checkValidity()) {
          formBtn.removeAttribute('disabled');
        } else {
          formBtn.setAttribute('disabled', '');
        }
      })
    }

    // Enabling Page Navigation 

    const navigationLinks = document.querySelectorAll('[data-nav-link]');
    const pages = document.querySelectorAll('[data-page]');

    for (let i = 0; i < navigationLinks.length; i++) {
      navigationLinks[i].addEventListener('click', function () {

        for (let i = 0; i < pages.length; i++) {
          if (this.innerHTML.toLowerCase() == pages[i].dataset.page) {
            pages[i].classList.add('active');
            navigationLinks[i].classList.add('active');
            window.scrollTo(0, 0);
          } else {
            pages[i].classList.remove('active');
            navigationLinks[i].classList.remove('active');
          }
        }
      });
    }
  </script>

  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>