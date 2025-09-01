CREATE TABLE public.enseignant
(
    id_enseignant serial,
    code_matiere integer,
    nom text,
    prenom text,
    nom_matiere text,
    PRIMARY KEY (id_enseignant),
    CONSTRAINT unique_code_matiere UNIQUE (code_matiere)
)
WITH (
    OIDS = FALSE
);

ALTER TABLE IF EXISTS public.enseignant
    OWNER to postgres;