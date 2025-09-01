--
-- PostgreSQL database dump
--

-- Dumped from database version 11.16
-- Dumped by pg_dump version 11.16

-- Started on 2025-08-20 08:03:34

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 197 (class 1259 OID 28366)
-- Name: eleve; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.eleve (
    id_eleve integer NOT NULL,
    nom text,
    prenom text,
    age integer,
    sexe text,
    matricule integer,
    date_naissance date,
    pere text,
    mere text,
    adresse text,
    code_filier integer
);


ALTER TABLE public.eleve OWNER TO postgres;

--
-- TOC entry 196 (class 1259 OID 28364)
-- Name: eleve_id_eleve_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.eleve_id_eleve_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.eleve_id_eleve_seq OWNER TO postgres;

--
-- TOC entry 2901 (class 0 OID 0)
-- Dependencies: 196
-- Name: eleve_id_eleve_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.eleve_id_eleve_seq OWNED BY public.eleve.id_eleve;


--
-- TOC entry 199 (class 1259 OID 28390)
-- Name: enseignant; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.enseignant (
    id_enseignant integer NOT NULL,
    code_matiere integer,
    nom text,
    prenom text,
    code_enseignant integer,
    matricule integer,
    sexe text,
    telephone text,
    adresse text,
    grade character varying(30),
    statut text,
    date_naissance date,
    date_recrutement date,
    email text,
    code_filiere integer
);


ALTER TABLE public.enseignant OWNER TO postgres;

--
-- TOC entry 198 (class 1259 OID 28388)
-- Name: enseignant_id_enseignant_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.enseignant_id_enseignant_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.enseignant_id_enseignant_seq OWNER TO postgres;

--
-- TOC entry 2902 (class 0 OID 0)
-- Dependencies: 198
-- Name: enseignant_id_enseignant_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.enseignant_id_enseignant_seq OWNED BY public.enseignant.id_enseignant;


--
-- TOC entry 203 (class 1259 OID 28447)
-- Name: filier; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.filier (
    id_filier integer NOT NULL,
    code_filier integer,
    nom_filier text
);


ALTER TABLE public.filier OWNER TO postgres;

--
-- TOC entry 202 (class 1259 OID 28445)
-- Name: filier_id_filier_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.filier_id_filier_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.filier_id_filier_seq OWNER TO postgres;

--
-- TOC entry 2903 (class 0 OID 0)
-- Dependencies: 202
-- Name: filier_id_filier_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.filier_id_filier_seq OWNED BY public.filier.id_filier;


--
-- TOC entry 206 (class 1259 OID 44758)
-- Name: filiere_matiere; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.filiere_matiere (
    code_filier integer NOT NULL,
    code_matiere integer NOT NULL
);


ALTER TABLE public.filiere_matiere OWNER TO postgres;

--
-- TOC entry 201 (class 1259 OID 28422)
-- Name: matiere; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.matiere (
    id_matiere integer NOT NULL,
    code_matiere integer,
    nom_matiere text,
    volume_horaire integer,
    coefficient integer
);


ALTER TABLE public.matiere OWNER TO postgres;

--
-- TOC entry 200 (class 1259 OID 28420)
-- Name: matiere_id_matiere_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.matiere_id_matiere_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.matiere_id_matiere_seq OWNER TO postgres;

--
-- TOC entry 2904 (class 0 OID 0)
-- Dependencies: 200
-- Name: matiere_id_matiere_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.matiere_id_matiere_seq OWNED BY public.matiere.id_matiere;


--
-- TOC entry 205 (class 1259 OID 28474)
-- Name: note; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.note (
    id_note integer NOT NULL,
    matricule integer,
    code_filiere integer,
    code_matiere integer,
    note double precision
);


ALTER TABLE public.note OWNER TO postgres;

--
-- TOC entry 204 (class 1259 OID 28472)
-- Name: note_id_note_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.note_id_note_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.note_id_note_seq OWNER TO postgres;

--
-- TOC entry 2905 (class 0 OID 0)
-- Dependencies: 204
-- Name: note_id_note_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.note_id_note_seq OWNED BY public.note.id_note;


--
-- TOC entry 208 (class 1259 OID 44780)
-- Name: utilisateur; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.utilisateur (
    id_utilisateur integer NOT NULL,
    "nomUtilisateur" text NOT NULL,
    prenom text,
    role text,
    password text
);


ALTER TABLE public.utilisateur OWNER TO postgres;

--
-- TOC entry 207 (class 1259 OID 44778)
-- Name: utilisateur_id_utilisateur_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.utilisateur_id_utilisateur_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.utilisateur_id_utilisateur_seq OWNER TO postgres;

--
-- TOC entry 2906 (class 0 OID 0)
-- Dependencies: 207
-- Name: utilisateur_id_utilisateur_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.utilisateur_id_utilisateur_seq OWNED BY public.utilisateur.id_utilisateur;


--
-- TOC entry 2724 (class 2604 OID 28369)
-- Name: eleve id_eleve; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.eleve ALTER COLUMN id_eleve SET DEFAULT nextval('public.eleve_id_eleve_seq'::regclass);


--
-- TOC entry 2725 (class 2604 OID 28393)
-- Name: enseignant id_enseignant; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.enseignant ALTER COLUMN id_enseignant SET DEFAULT nextval('public.enseignant_id_enseignant_seq'::regclass);


--
-- TOC entry 2727 (class 2604 OID 28450)
-- Name: filier id_filier; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.filier ALTER COLUMN id_filier SET DEFAULT nextval('public.filier_id_filier_seq'::regclass);


--
-- TOC entry 2726 (class 2604 OID 28425)
-- Name: matiere id_matiere; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.matiere ALTER COLUMN id_matiere SET DEFAULT nextval('public.matiere_id_matiere_seq'::regclass);


--
-- TOC entry 2728 (class 2604 OID 28477)
-- Name: note id_note; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.note ALTER COLUMN id_note SET DEFAULT nextval('public.note_id_note_seq'::regclass);


--
-- TOC entry 2729 (class 2604 OID 44783)
-- Name: utilisateur id_utilisateur; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.utilisateur ALTER COLUMN id_utilisateur SET DEFAULT nextval('public.utilisateur_id_utilisateur_seq'::regclass);


--
-- TOC entry 2884 (class 0 OID 28366)
-- Dependencies: 197
-- Data for Name: eleve; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.eleve (id_eleve, nom, prenom, age, sexe, matricule, date_naissance, pere, mere, adresse, code_filier) FROM stdin;
13	RAKOTONDRASO	Just	15	feminin	1205	2025-07-17	Charlotte	JEANNOT	\N	1
14	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N
16	RAKOTONDRASO	Just	15	feminin	120	2025-07-17	Charlotte	JEANNOT	\N	3
32	RAKOTONDRASO	Just	15	feminin	134	2025-07-17	Charlotte	JEANNOT	Amborogony Tanambao	3
33	RAKOTONDRASO	Just	15	feminin	1	2025-07-17	Charlotte	JEANNOT	Amborogony Tanambao	1
34	RAKOTO	Just	15	feminin	2	2025-07-17	Charlotte	JEANNOT	Amborogony Tanambao	1
35	RASOA	Just	15	feminin	3	2025-07-17	Charlotte	JEANNOT	Amborogony Tanambao	1
37	RASOA NIRINA	Just	15	feminin	4	2025-07-17	Charlotte	JEANNOT	Amborogony Tanambao	3
38	RASOA NIRINA	Just	15	feminin	5	2025-07-17	Charlotte	JEANNOT	Amborogony Tanambao	3
39	KOTO	Just	15	feminin	7	2025-07-17	Charlotte	JEANNOT	Amborogony Tanambao	3
40	KOTO KILEMAINA	Just	15	feminin	8	2025-07-17	Charlotte	JEANNOT	Amborogony Tanambao	4
41	ANDO	Just	15	feminin	9	2025-07-17	Charlotte	JEANNOT	Amborogony Tanambao	5
42	AMBOARA	Just	15	feminin	10	2025-07-17	Charlotte	JEANNOT	Amborogony Tanambao	5
43	AMBOARA	Just	15	feminin	888	2025-07-17	Charlotte	JEANNOT	Amborogony Tanambao	5
44	AMBOARA	Just	15	feminin	974	2025-07-17	Charlotte	JEANNOT	Amborogony Tanambao	2
45	KIRY	SEVA	15	feminin	123	2025-07-17	Charlotte	JEANNOT	Amborogony Tanambao	2
46	bebe	BET	15	HOMME	1256	2025-07-17	Charlotte	JEANNOT	Amborogony Tanambao	1
\.


--
-- TOC entry 2886 (class 0 OID 28390)
-- Dependencies: 199
-- Data for Name: enseignant; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.enseignant (id_enseignant, code_matiere, nom, prenom, code_enseignant, matricule, sexe, telephone, adresse, grade, statut, date_naissance, date_recrutement, email, code_filiere) FROM stdin;
14	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N
13	2	silvain	viviane	143	122	feminin	0320000000	Amborogony	licence	vacataire	1986-06-04	2008-01-01	rabenantoandroamboara@gmail.com	7
21	2	silvain	marianne	1326	125	feminin	0320000000	Amborogony	licence	vacataire	1986-06-04	2008-01-01	rabenantoandroamboara@gmail.com	7
22	2	silvain	marianne	13	12	feminin	0320000000	Amborogony	licence	titulaire	1986-06-04	2008-01-01	rabenantoandroamboara@gmail.com	7
12	2	silvain	viviane rose	1434	8502	feminin	034	Amborogony	licence	vacataire	1986-06-04	2008-01-01	rakotondrazaka@gmail.com	7
24	2	silvain	marianne	18	16	feminin	0320000000	Amborogony	licence	titulaire	1986-06-04	2008-01-01	rabenantoandroamboara@gmail.com	7
\.


--
-- TOC entry 2890 (class 0 OID 28447)
-- Dependencies: 203
-- Data for Name: filier; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.filier (id_filier, code_filier, nom_filier) FROM stdin;
1	1	T1
2	3	T2
3	4	T3
4	5	T4
5	6	sixième
10	7	cinqième
11	8	quatrième
12	9	troisième
13	10	seconde
14	11	première
15	12	terminale
16	2	TSIS
17	13	EPS
23	14	Philosofie
27	\N	\N
\.


--
-- TOC entry 2893 (class 0 OID 44758)
-- Dependencies: 206
-- Data for Name: filiere_matiere; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.filiere_matiere (code_filier, code_matiere) FROM stdin;
1	1
1	2
1	3
2	1
2	2
2	3
2	4
1	7
\.


--
-- TOC entry 2888 (class 0 OID 28422)
-- Dependencies: 201
-- Data for Name: matiere; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.matiere (id_matiere, code_matiere, nom_matiere, volume_horaire, coefficient) FROM stdin;
4	2	français	32	2
5	3	Angalais	42	2
3	1	malagasy	45	2
7	5	Mathématique	100	3
8	6	Phisique	100	3
6	4	Histoir-geographie	100	4
9	7	philosofie	45	4
\.


--
-- TOC entry 2892 (class 0 OID 28474)
-- Dependencies: 205
-- Data for Name: note; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.note (id_note, matricule, code_filiere, code_matiere, note) FROM stdin;
51	4	1	1	6
52	7	2	1	6
53	8	3	2	13
54	1	3	1	45
55	1	2	4	23
56	1	1	1	56
57	2	2	2	23
\.


--
-- TOC entry 2895 (class 0 OID 44780)
-- Dependencies: 208
-- Data for Name: utilisateur; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.utilisateur (id_utilisateur, "nomUtilisateur", prenom, role, password) FROM stdin;
3	admin	jesui	admin	$2y$10$Gv9MnTRdK06CJdlCqOOBguZzl7TAgYLABVQG6bLIQsxik84UKP0dS
4	admin	admin	enseignant	$2y$10$ymMcZDZnf2hcr0t2IyclFukTDNJiBmtBYxgCo1nchOxbEhbNRWc2G
5	admin	admin	admin	$2y$10$9dEwS67CSYP3lEPM2baqyO3F51KtwOSjo39GvA.udbO2aAN1Jm9SO
6	lots	rabe	superadmin	$2y$10$uIQhAGq2Yqrs/gEGGZ7vGepXQWWyo1IFAK4TxOdBR1t9IKAkicgSq
\.


--
-- TOC entry 2907 (class 0 OID 0)
-- Dependencies: 196
-- Name: eleve_id_eleve_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.eleve_id_eleve_seq', 46, true);


--
-- TOC entry 2908 (class 0 OID 0)
-- Dependencies: 198
-- Name: enseignant_id_enseignant_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.enseignant_id_enseignant_seq', 24, true);


--
-- TOC entry 2909 (class 0 OID 0)
-- Dependencies: 202
-- Name: filier_id_filier_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.filier_id_filier_seq', 30, true);


--
-- TOC entry 2910 (class 0 OID 0)
-- Dependencies: 200
-- Name: matiere_id_matiere_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.matiere_id_matiere_seq', 9, true);


--
-- TOC entry 2911 (class 0 OID 0)
-- Dependencies: 204
-- Name: note_id_note_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.note_id_note_seq', 57, true);


--
-- TOC entry 2912 (class 0 OID 0)
-- Dependencies: 207
-- Name: utilisateur_id_utilisateur_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.utilisateur_id_utilisateur_seq', 6, true);


--
-- TOC entry 2731 (class 2606 OID 28374)
-- Name: eleve eleve_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.eleve
    ADD CONSTRAINT eleve_pkey PRIMARY KEY (id_eleve);


--
-- TOC entry 2735 (class 2606 OID 28398)
-- Name: enseignant enseignant_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.enseignant
    ADD CONSTRAINT enseignant_pkey PRIMARY KEY (id_enseignant);


--
-- TOC entry 2745 (class 2606 OID 28452)
-- Name: filier filier_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.filier
    ADD CONSTRAINT filier_pkey PRIMARY KEY (id_filier);


--
-- TOC entry 2751 (class 2606 OID 44762)
-- Name: filiere_matiere filiere_matiere_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.filiere_matiere
    ADD CONSTRAINT filiere_matiere_pkey PRIMARY KEY (code_filier, code_matiere);


--
-- TOC entry 2741 (class 2606 OID 28430)
-- Name: matiere matiere_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.matiere
    ADD CONSTRAINT matiere_pkey PRIMARY KEY (id_matiere);


--
-- TOC entry 2749 (class 2606 OID 28479)
-- Name: note note_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.note
    ADD CONSTRAINT note_pkey PRIMARY KEY (id_note);


--
-- TOC entry 2737 (class 2606 OID 28439)
-- Name: enseignant unique_code_enseignant; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.enseignant
    ADD CONSTRAINT unique_code_enseignant UNIQUE (code_enseignant);


--
-- TOC entry 2747 (class 2606 OID 28454)
-- Name: filier unique_code_filier; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.filier
    ADD CONSTRAINT unique_code_filier UNIQUE (code_filier);


--
-- TOC entry 2743 (class 2606 OID 28432)
-- Name: matiere unique_code_matiere; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.matiere
    ADD CONSTRAINT unique_code_matiere UNIQUE (code_matiere);


--
-- TOC entry 2739 (class 2606 OID 28464)
-- Name: enseignant unique_matrcl_enseignant; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.enseignant
    ADD CONSTRAINT unique_matrcl_enseignant UNIQUE (matricule);


--
-- TOC entry 2733 (class 2606 OID 28466)
-- Name: eleve unique_mtricule_eleve; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.eleve
    ADD CONSTRAINT unique_mtricule_eleve UNIQUE (matricule);


--
-- TOC entry 2753 (class 2606 OID 44788)
-- Name: utilisateur utilisateur_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.utilisateur
    ADD CONSTRAINT utilisateur_pkey PRIMARY KEY (id_utilisateur);


--
-- TOC entry 2760 (class 2606 OID 44763)
-- Name: filiere_matiere filiere_matiere_code_filier_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.filiere_matiere
    ADD CONSTRAINT filiere_matiere_code_filier_fkey FOREIGN KEY (code_filier) REFERENCES public.filier(code_filier) ON DELETE CASCADE;


--
-- TOC entry 2761 (class 2606 OID 44768)
-- Name: filiere_matiere filiere_matiere_code_matiere_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.filiere_matiere
    ADD CONSTRAINT filiere_matiere_code_matiere_fkey FOREIGN KEY (code_matiere) REFERENCES public.matiere(code_matiere) ON DELETE CASCADE;


--
-- TOC entry 2756 (class 2606 OID 28467)
-- Name: enseignant foreign_codefiliere; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.enseignant
    ADD CONSTRAINT foreign_codefiliere FOREIGN KEY (code_filiere) REFERENCES public.filier(code_filier) NOT VALID;


--
-- TOC entry 2754 (class 2606 OID 28458)
-- Name: eleve foreign_key_code_filier; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.eleve
    ADD CONSTRAINT foreign_key_code_filier FOREIGN KEY (code_filier) REFERENCES public.filier(code_filier) NOT VALID;


--
-- TOC entry 2758 (class 2606 OID 28485)
-- Name: note foreign_key_code_filier; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.note
    ADD CONSTRAINT foreign_key_code_filier FOREIGN KEY (code_filiere) REFERENCES public.filier(code_filier);


--
-- TOC entry 2759 (class 2606 OID 28490)
-- Name: note foreign_key_code_matiere; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.note
    ADD CONSTRAINT foreign_key_code_matiere FOREIGN KEY (code_matiere) REFERENCES public.matiere(code_matiere);


--
-- TOC entry 2757 (class 2606 OID 28480)
-- Name: note foreign_key_matricile; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.note
    ADD CONSTRAINT foreign_key_matricile FOREIGN KEY (matricule) REFERENCES public.eleve(matricule);


--
-- TOC entry 2755 (class 2606 OID 28433)
-- Name: enseignant freign_key_code_matiere; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.enseignant
    ADD CONSTRAINT freign_key_code_matiere FOREIGN KEY (code_matiere) REFERENCES public.matiere(code_matiere) NOT VALID;


-- Completed on 2025-08-20 08:03:34

--
-- PostgreSQL database dump complete
--

