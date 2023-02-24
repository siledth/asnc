--
-- PostgreSQL database dump
--

-- Dumped from database version 14.3 (Ubuntu 14.3-1.pgdg20.04+1)
-- Dumped by pg_dump version 14.3 (Ubuntu 14.3-1.pgdg20.04+1)

-- Started on 2023-02-24 02:32:03 -04

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

--
-- TOC entry 8 (class 2615 OID 325127)
-- Name: certificacion; Type: SCHEMA; Schema: -; Owner: postgres
--

CREATE SCHEMA certificacion;


ALTER SCHEMA certificacion OWNER TO postgres;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- TOC entry 381 (class 1259 OID 341528)
-- Name: certificaciones; Type: TABLE; Schema: certificacion; Owner: postgres
--

CREATE TABLE certificacion.certificaciones (
    id integer NOT NULL,
    nro_comprobante character varying,
    nombre character varying(100),
    rif_cont character varying(12),
    n_certif character varying(200),
    tipo_pers integer,
    vigen_cert_desde date,
    vigen_cert_hasta date,
    observacion text,
    user_snc_aprob integer,
    fecha_status date,
    objetivo text,
    cont_prog text,
    total_bss character varying(150),
    n_ref character varying(50),
    banco_e character varying(100),
    banco_rec character varying(100),
    fecha_trans date,
    monto_trans numeric,
    declara text,
    acepto character varying(2),
    fecha_solic date,
    user_soli integer,
    status integer
);


ALTER TABLE certificacion.certificaciones OWNER TO postgres;

--
-- TOC entry 380 (class 1259 OID 341527)
-- Name: certificaciones_id_seq; Type: SEQUENCE; Schema: certificacion; Owner: postgres
--

CREATE SEQUENCE certificacion.certificaciones_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE certificacion.certificaciones_id_seq OWNER TO postgres;

--
-- TOC entry 3761 (class 0 OID 0)
-- Dependencies: 380
-- Name: certificaciones_id_seq; Type: SEQUENCE OWNED BY; Schema: certificacion; Owner: postgres
--

ALTER SEQUENCE certificacion.certificaciones_id_seq OWNED BY certificacion.certificaciones.id;


--
-- TOC entry 379 (class 1259 OID 325212)
-- Name: exp_dic_cap_3; Type: TABLE; Schema: certificacion; Owner: postgres
--

CREATE TABLE certificacion.exp_dic_cap_3 (
    id integer NOT NULL,
    rif_cont character varying(12),
    n_certif character varying(200),
    organo3 character varying(100),
    actividad3 character varying(50),
    desde3 date,
    hasta3 date
);


ALTER TABLE certificacion.exp_dic_cap_3 OWNER TO postgres;

--
-- TOC entry 378 (class 1259 OID 325211)
-- Name: exp_dic_cap_3_id_seq; Type: SEQUENCE; Schema: certificacion; Owner: postgres
--

CREATE SEQUENCE certificacion.exp_dic_cap_3_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE certificacion.exp_dic_cap_3_id_seq OWNER TO postgres;

--
-- TOC entry 3762 (class 0 OID 0)
-- Dependencies: 378
-- Name: exp_dic_cap_3_id_seq; Type: SEQUENCE OWNED BY; Schema: certificacion; Owner: postgres
--

ALTER SEQUENCE certificacion.exp_dic_cap_3_id_seq OWNED BY certificacion.exp_dic_cap_3.id;


--
-- TOC entry 377 (class 1259 OID 325207)
-- Name: exp_par_comi_10; Type: TABLE; Schema: certificacion; Owner: postgres
--

CREATE TABLE certificacion.exp_par_comi_10 (
    id integer NOT NULL,
    rif_cont character varying(12),
    n_certif character varying(200),
    organo10 character varying(100),
    act_adminis_desid character varying(20),
    n_acto character varying(50),
    fecha_act date,
    area_10 character varying(30),
    dura_comi character varying(30)
);


ALTER TABLE certificacion.exp_par_comi_10 OWNER TO postgres;

--
-- TOC entry 376 (class 1259 OID 325206)
-- Name: exp_par_comi_10_id_seq; Type: SEQUENCE; Schema: certificacion; Owner: postgres
--

CREATE SEQUENCE certificacion.exp_par_comi_10_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE certificacion.exp_par_comi_10_id_seq OWNER TO postgres;

--
-- TOC entry 3763 (class 0 OID 0)
-- Dependencies: 376
-- Name: exp_par_comi_10_id_seq; Type: SEQUENCE OWNED BY; Schema: certificacion; Owner: postgres
--

ALTER SEQUENCE certificacion.exp_par_comi_10_id_seq OWNED BY certificacion.exp_par_comi_10.id;


--
-- TOC entry 369 (class 1259 OID 325179)
-- Name: experi_empre_cap_comisi; Type: TABLE; Schema: certificacion; Owner: postgres
--

CREATE TABLE certificacion.experi_empre_cap_comisi (
    id integer NOT NULL,
    nro_comprobante character varying,
    rif_cont character varying(12),
    n_certif character varying(200),
    organo_expe character varying(100),
    actividad_exp character varying(100),
    desde_exp date,
    hasta_exp date
);


ALTER TABLE certificacion.experi_empre_cap_comisi OWNER TO postgres;

--
-- TOC entry 368 (class 1259 OID 325178)
-- Name: experi_empre_cap_comisi_id_seq; Type: SEQUENCE; Schema: certificacion; Owner: postgres
--

CREATE SEQUENCE certificacion.experi_empre_cap_comisi_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE certificacion.experi_empre_cap_comisi_id_seq OWNER TO postgres;

--
-- TOC entry 3764 (class 0 OID 0)
-- Dependencies: 368
-- Name: experi_empre_cap_comisi_id_seq; Type: SEQUENCE OWNED BY; Schema: certificacion; Owner: postgres
--

ALTER SEQUENCE certificacion.experi_empre_cap_comisi_id_seq OWNED BY certificacion.experi_empre_cap_comisi.id;


--
-- TOC entry 367 (class 1259 OID 325158)
-- Name: experi_empre_capa; Type: TABLE; Schema: certificacion; Owner: postgres
--

CREATE TABLE certificacion.experi_empre_capa (
    id integer NOT NULL,
    nro_comprobante character varying,
    rif_cont character varying(12),
    n_certif character varying(200),
    organo_experi_empre_capa character varying(100),
    actividad_experi_empre_capa character varying(200),
    desde_experi_empre_capa date,
    hasta_experi_empre_capa date
);


ALTER TABLE certificacion.experi_empre_capa OWNER TO postgres;

--
-- TOC entry 366 (class 1259 OID 325157)
-- Name: experi_empre_capa_id_seq; Type: SEQUENCE; Schema: certificacion; Owner: postgres
--

CREATE SEQUENCE certificacion.experi_empre_capa_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE certificacion.experi_empre_capa_id_seq OWNER TO postgres;

--
-- TOC entry 3765 (class 0 OID 0)
-- Dependencies: 366
-- Name: experi_empre_capa_id_seq; Type: SEQUENCE OWNED BY; Schema: certificacion; Owner: postgres
--

ALTER SEQUENCE certificacion.experi_empre_capa_id_seq OWNED BY certificacion.experi_empre_capa.id;


--
-- TOC entry 375 (class 1259 OID 325199)
-- Name: for_mat_contr_publ; Type: TABLE; Schema: certificacion; Owner: postgres
--

CREATE TABLE certificacion.for_mat_contr_publ (
    id integer NOT NULL,
    rif_cont character varying(12),
    n_certif character varying(200),
    taller character varying(100),
    institucion character varying(100),
    hor_dura character varying(10),
    certi character varying(50),
    fech_cert date,
    vigencia character varying(20),
    nro_comprobante character varying(100)
);


ALTER TABLE certificacion.for_mat_contr_publ OWNER TO postgres;

--
-- TOC entry 374 (class 1259 OID 325198)
-- Name: for_mat_contr_publ_id_seq; Type: SEQUENCE; Schema: certificacion; Owner: postgres
--

CREATE SEQUENCE certificacion.for_mat_contr_publ_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE certificacion.for_mat_contr_publ_id_seq OWNER TO postgres;

--
-- TOC entry 3766 (class 0 OID 0)
-- Dependencies: 374
-- Name: for_mat_contr_publ_id_seq; Type: SEQUENCE OWNED BY; Schema: certificacion; Owner: postgres
--

ALTER SEQUENCE certificacion.for_mat_contr_publ_id_seq OWNED BY certificacion.for_mat_contr_publ.id;


--
-- TOC entry 371 (class 1259 OID 325187)
-- Name: infor_per_natu; Type: TABLE; Schema: certificacion; Owner: postgres
--

CREATE TABLE certificacion.infor_per_natu (
    id integer NOT NULL,
    nro_comprobante character varying,
    rif_cont character varying(12),
    n_certif character varying(200),
    nombre_ape character varying(100),
    tipo_cedula character varying(1),
    cedula character varying(10),
    rif character varying(10),
    bolivar_estimado character varying(100),
    pj character varying(100),
    sub_total character varying(100),
    total_final character varying(100)
);


ALTER TABLE certificacion.infor_per_natu OWNER TO postgres;

--
-- TOC entry 370 (class 1259 OID 325186)
-- Name: infor_per_natu_id_seq; Type: SEQUENCE; Schema: certificacion; Owner: postgres
--

CREATE SEQUENCE certificacion.infor_per_natu_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE certificacion.infor_per_natu_id_seq OWNER TO postgres;

--
-- TOC entry 3767 (class 0 OID 0)
-- Dependencies: 370
-- Name: infor_per_natu_id_seq; Type: SEQUENCE OWNED BY; Schema: certificacion; Owner: postgres
--

ALTER SEQUENCE certificacion.infor_per_natu_id_seq OWNED BY certificacion.infor_per_natu.id;


--
-- TOC entry 373 (class 1259 OID 325194)
-- Name: infor_per_prof; Type: TABLE; Schema: certificacion; Owner: postgres
--

CREATE TABLE certificacion.infor_per_prof (
    id integer NOT NULL,
    rif_cont character varying(12),
    n_certif character varying(200),
    for_academica character varying(100),
    titulo character varying(100),
    ano character varying(10),
    culminacion character varying(10),
    curso character varying(2),
    nro_comprobante character varying(100)
);


ALTER TABLE certificacion.infor_per_prof OWNER TO postgres;

--
-- TOC entry 372 (class 1259 OID 325193)
-- Name: infor_per_prof_id_seq; Type: SEQUENCE; Schema: certificacion; Owner: postgres
--

CREATE SEQUENCE certificacion.infor_per_prof_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE certificacion.infor_per_prof_id_seq OWNER TO postgres;

--
-- TOC entry 3768 (class 0 OID 0)
-- Dependencies: 372
-- Name: infor_per_prof_id_seq; Type: SEQUENCE OWNED BY; Schema: certificacion; Owner: postgres
--

ALTER SEQUENCE certificacion.infor_per_prof_id_seq OWNED BY certificacion.infor_per_prof.id;


--
-- TOC entry 365 (class 1259 OID 325140)
-- Name: tarifas; Type: TABLE; Schema: certificacion; Owner: postgres
--

CREATE TABLE certificacion.tarifas (
    id_tarifa integer,
    descripcion character varying(50),
    valor character varying(100),
    fecha_creacion date,
    fecha_update date,
    id_usuaio integer
);


ALTER TABLE certificacion.tarifas OWNER TO postgres;

--
-- TOC entry 3593 (class 2604 OID 341531)
-- Name: certificaciones id; Type: DEFAULT; Schema: certificacion; Owner: postgres
--

ALTER TABLE ONLY certificacion.certificaciones ALTER COLUMN id SET DEFAULT nextval('certificacion.certificaciones_id_seq'::regclass);


--
-- TOC entry 3592 (class 2604 OID 325215)
-- Name: exp_dic_cap_3 id; Type: DEFAULT; Schema: certificacion; Owner: postgres
--

ALTER TABLE ONLY certificacion.exp_dic_cap_3 ALTER COLUMN id SET DEFAULT nextval('certificacion.exp_dic_cap_3_id_seq'::regclass);


--
-- TOC entry 3591 (class 2604 OID 325210)
-- Name: exp_par_comi_10 id; Type: DEFAULT; Schema: certificacion; Owner: postgres
--

ALTER TABLE ONLY certificacion.exp_par_comi_10 ALTER COLUMN id SET DEFAULT nextval('certificacion.exp_par_comi_10_id_seq'::regclass);


--
-- TOC entry 3587 (class 2604 OID 325182)
-- Name: experi_empre_cap_comisi id; Type: DEFAULT; Schema: certificacion; Owner: postgres
--

ALTER TABLE ONLY certificacion.experi_empre_cap_comisi ALTER COLUMN id SET DEFAULT nextval('certificacion.experi_empre_cap_comisi_id_seq'::regclass);


--
-- TOC entry 3586 (class 2604 OID 325161)
-- Name: experi_empre_capa id; Type: DEFAULT; Schema: certificacion; Owner: postgres
--

ALTER TABLE ONLY certificacion.experi_empre_capa ALTER COLUMN id SET DEFAULT nextval('certificacion.experi_empre_capa_id_seq'::regclass);


--
-- TOC entry 3590 (class 2604 OID 325202)
-- Name: for_mat_contr_publ id; Type: DEFAULT; Schema: certificacion; Owner: postgres
--

ALTER TABLE ONLY certificacion.for_mat_contr_publ ALTER COLUMN id SET DEFAULT nextval('certificacion.for_mat_contr_publ_id_seq'::regclass);


--
-- TOC entry 3588 (class 2604 OID 325190)
-- Name: infor_per_natu id; Type: DEFAULT; Schema: certificacion; Owner: postgres
--

ALTER TABLE ONLY certificacion.infor_per_natu ALTER COLUMN id SET DEFAULT nextval('certificacion.infor_per_natu_id_seq'::regclass);


--
-- TOC entry 3589 (class 2604 OID 325197)
-- Name: infor_per_prof id; Type: DEFAULT; Schema: certificacion; Owner: postgres
--

ALTER TABLE ONLY certificacion.infor_per_prof ALTER COLUMN id SET DEFAULT nextval('certificacion.infor_per_prof_id_seq'::regclass);


--
-- TOC entry 3755 (class 0 OID 341528)
-- Dependencies: 381
-- Data for Name: certificaciones; Type: TABLE DATA; Schema: certificacion; Owner: postgres
--

COPY certificacion.certificaciones (id, nro_comprobante, nombre, rif_cont, n_certif, tipo_pers, vigen_cert_desde, vigen_cert_hasta, observacion, user_snc_aprob, fecha_status, objetivo, cont_prog, total_bss, n_ref, banco_e, banco_rec, fecha_trans, monto_trans, declara, acepto, fecha_solic, user_soli, status) FROM stdin;
1	PJ-00000000000000000001	NIKODEMO SYSTEMS, C.A.	J411174807	1374840411174807217	1	2023-02-24	2025-02-24	APROBADO	1	2023-02-24	PRUEBA PERSONA JURIDICA	PRUEBA PERSONA JURIDICA	722,1	152	BANCO DE VENEZUELA	BANCO DE VENEZUELA	2023-02-24	256	Declaro que la información y datos suministrados en esta Ficha son fidedignos, por lo que autorizo la pertinencia de su verificación. Convengo que de llegar a comprobarse que se ha incurrido en inexactitud o falsedad en los datos aquí suministrados, quedará sin efecto la CERTIFICACIÓN.	Si	2023-02-24	1	2
2	PN-00000000000000000001	A.P.S. CONSULTORES Y ASOCIADOS C.A.	J304354487	1376973304354487213	2	2023-02-24	2025-02-24	PERSONA NATURAL	1	2023-02-24	PROBANDO PERSONA NATURAL	PROBANDO PERSONA NATURAL	\N	758	MERCANTIL	BANCO DE VENEZUELA	2023-02-24	234	Declaro que la información y datos suministrados en esta Ficha son fidedignos, por lo que autorizo la pertinencia de su verificación. Convengo que de llegar a comprobarse que se ha incurrido en inexactitud o falsedad en los datos aquí suministrados, quedará sin efecto la CERTIFICACIÓN.	Si	2023-02-24	1	2
\.


--
-- TOC entry 3753 (class 0 OID 325212)
-- Dependencies: 379
-- Data for Name: exp_dic_cap_3; Type: TABLE DATA; Schema: certificacion; Owner: postgres
--

COPY certificacion.exp_dic_cap_3 (id, rif_cont, n_certif, organo3, actividad3, desde3, hasta3) FROM stdin;
1	J411174807	1374840411174807217	111	GGG	2023-02-10	2023-02-24
2	J304354487	1376973304354487213	4444	444	2022-02-03	2023-02-24
\.


--
-- TOC entry 3751 (class 0 OID 325207)
-- Dependencies: 377
-- Data for Name: exp_par_comi_10; Type: TABLE DATA; Schema: certificacion; Owner: postgres
--

COPY certificacion.exp_par_comi_10 (id, rif_cont, n_certif, organo10, act_adminis_desid, n_acto, fecha_act, area_10, dura_comi) FROM stdin;
1	J411174807	1374840411174807217	111	Resolución	111	2023-02-03	Económica Financiera	111
2	J304354487	1376973304354487213	333	Punto de Cuenta	345	2022-05-03	Técnica	344
\.


--
-- TOC entry 3743 (class 0 OID 325179)
-- Dependencies: 369
-- Data for Name: experi_empre_cap_comisi; Type: TABLE DATA; Schema: certificacion; Owner: postgres
--

COPY certificacion.experi_empre_cap_comisi (id, nro_comprobante, rif_cont, n_certif, organo_expe, actividad_exp, desde_exp, hasta_exp) FROM stdin;
1	PJ-00000000000000000001	J411174807	1374840411174807217	PRUEBA PERSONA JURIDICA	PRUEBA PERSONA JURIDICA	2023-02-02	2023-02-10
\.


--
-- TOC entry 3741 (class 0 OID 325158)
-- Dependencies: 367
-- Data for Name: experi_empre_capa; Type: TABLE DATA; Schema: certificacion; Owner: postgres
--

COPY certificacion.experi_empre_capa (id, nro_comprobante, rif_cont, n_certif, organo_experi_empre_capa, actividad_experi_empre_capa, desde_experi_empre_capa, hasta_experi_empre_capa) FROM stdin;
1	PJ-00000000000000000001	J411174807	1374840411174807217	PRUEBA PERSONA JURIDICA	PRUEBA PERSONA JURIDICA	2023-02-01	2023-02-24
\.


--
-- TOC entry 3749 (class 0 OID 325199)
-- Dependencies: 375
-- Data for Name: for_mat_contr_publ; Type: TABLE DATA; Schema: certificacion; Owner: postgres
--

COPY certificacion.for_mat_contr_publ (id, rif_cont, n_certif, taller, institucion, hor_dura, certi, fech_cert, vigencia, nro_comprobante) FROM stdin;
1	J411174807	1374840411174807217	NOMBRE	NOMBRE	1	4555	2023-02-23	0	PJ-00000000000000000001
2	J411174807	1374840411174807217	PROBANDO PERSONA NATURAL 1	TALLER BENJAMIN	250	256355	2022-02-03	1	PN-00000000000000000001
2	J304354487	1376973304354487213	TALLER	SNC	58	2585	2020-10-08	2	PN-00000000000000000001
1	J411174807	1374840411174807217	111	111	14	14	2021-11-03	1	PJ-00000000000000000001
2	J304354487	1376973304354487213	EEE	EEE	333	333	2023-02-24	0	PN-00000000000000000001
\.


--
-- TOC entry 3745 (class 0 OID 325187)
-- Dependencies: 371
-- Data for Name: infor_per_natu; Type: TABLE DATA; Schema: certificacion; Owner: postgres
--

COPY certificacion.infor_per_natu (id, nro_comprobante, rif_cont, n_certif, nombre_ape, tipo_cedula, cedula, rif, bolivar_estimado, pj, sub_total, total_final) FROM stdin;
1	PJ-00000000000000000001	J411174807	1374840411174807217	BENJAMIN	\N	V15545148	V155458	124,50	498,00	622,5	722,1
2	PN-00000000000000000001	J304354487	1376973304354487213	SUÁREZ ARAB, RAMON	\N	V6429731	V304354487	498,00	\N	79,68	577,68
\.


--
-- TOC entry 3747 (class 0 OID 325194)
-- Dependencies: 373
-- Data for Name: infor_per_prof; Type: TABLE DATA; Schema: certificacion; Owner: postgres
--

COPY certificacion.infor_per_prof (id, rif_cont, n_certif, for_academica, titulo, ano, culminacion, curso, nro_comprobante) FROM stdin;
1	J411174807	1374840411174807217	Postgrado	ING INFORMATICA	2008	2010	No	PJ-00000000000000000001
2	J304354487	1376973304354487213	Licenciatura	TESTER	2020	2021	No	PN-00000000000000000001
\.


--
-- TOC entry 3739 (class 0 OID 325140)
-- Dependencies: 365
-- Data for Name: tarifas; Type: TABLE DATA; Schema: certificacion; Owner: postgres
--

COPY certificacion.tarifas (id_tarifa, descripcion, valor, fecha_creacion, fecha_update, id_usuaio) FROM stdin;
3	Facilitador	124,50	2023-02-16	\N	1
1	PJ	498,00	2023-02-16	\N	1
2	PN	498,00	2023-02-16	\N	1
\.


--
-- TOC entry 3769 (class 0 OID 0)
-- Dependencies: 380
-- Name: certificaciones_id_seq; Type: SEQUENCE SET; Schema: certificacion; Owner: postgres
--

SELECT pg_catalog.setval('certificacion.certificaciones_id_seq', 1, false);


--
-- TOC entry 3770 (class 0 OID 0)
-- Dependencies: 378
-- Name: exp_dic_cap_3_id_seq; Type: SEQUENCE SET; Schema: certificacion; Owner: postgres
--

SELECT pg_catalog.setval('certificacion.exp_dic_cap_3_id_seq', 1, false);


--
-- TOC entry 3771 (class 0 OID 0)
-- Dependencies: 376
-- Name: exp_par_comi_10_id_seq; Type: SEQUENCE SET; Schema: certificacion; Owner: postgres
--

SELECT pg_catalog.setval('certificacion.exp_par_comi_10_id_seq', 1, false);


--
-- TOC entry 3772 (class 0 OID 0)
-- Dependencies: 368
-- Name: experi_empre_cap_comisi_id_seq; Type: SEQUENCE SET; Schema: certificacion; Owner: postgres
--

SELECT pg_catalog.setval('certificacion.experi_empre_cap_comisi_id_seq', 17, true);


--
-- TOC entry 3773 (class 0 OID 0)
-- Dependencies: 366
-- Name: experi_empre_capa_id_seq; Type: SEQUENCE SET; Schema: certificacion; Owner: postgres
--

SELECT pg_catalog.setval('certificacion.experi_empre_capa_id_seq', 17, true);


--
-- TOC entry 3774 (class 0 OID 0)
-- Dependencies: 374
-- Name: for_mat_contr_publ_id_seq; Type: SEQUENCE SET; Schema: certificacion; Owner: postgres
--

SELECT pg_catalog.setval('certificacion.for_mat_contr_publ_id_seq', 1, false);


--
-- TOC entry 3775 (class 0 OID 0)
-- Dependencies: 370
-- Name: infor_per_natu_id_seq; Type: SEQUENCE SET; Schema: certificacion; Owner: postgres
--

SELECT pg_catalog.setval('certificacion.infor_per_natu_id_seq', 1, false);


--
-- TOC entry 3776 (class 0 OID 0)
-- Dependencies: 372
-- Name: infor_per_prof_id_seq; Type: SEQUENCE SET; Schema: certificacion; Owner: postgres
--

SELECT pg_catalog.setval('certificacion.infor_per_prof_id_seq', 1, false);


-- Completed on 2023-02-24 02:32:03 -04

--
-- PostgreSQL database dump complete
--

