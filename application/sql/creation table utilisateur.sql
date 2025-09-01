CREATE TABLE public.utilisateur
(
    id_utilisateur serial NOT NULL,
    "nomUtilisateur" text NOT NULL,
    prenom text,
    role text,
    password integer NOT NULL,
    PRIMARY KEY (id_utilisateur)
)
WITH (
    OIDS = FALSE
);

ALTER TABLE IF EXISTS public.utilisateur
    OWNER to postgres;