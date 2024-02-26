using Backend_TuPreferes.DataBase;
using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Diagnostics;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
/*
 * Auteur : Yoann Meier, Alexandre Babich
 * Projet : Administration du jeu web Tu Prefere
 * Description : Page principale de l'application
 */
namespace Backend_TuPreferes
{
    public partial class frmPagePrincipale : Form
    {
        FunctionDB functionDB;
        public frmPagePrincipale()
        {
            InitializeComponent();
            functionDB = new FunctionDB(new DB("localhost", "root", "Super", "TuPrefere",3306));
            LoadDataInListBoxDilemme(functionDB.GetAllDilemma());
            LoadDataInListBoxCategorie(functionDB.GetAllCategory());
            LoadCategoriesToComboBox(functionDB.GetAllCategory());
        }

        /// <summary>
        /// Affiche les dilemmes transmis en paramètres dans la listbox dilemme
        /// </summary>
        /// <param name="dilemmes">les dilemmes a afficher</param>
        private void LoadDataInListBoxDilemme(List<string[]> dilemmes)
        {
            lsbDilemmes.Items.Clear();
            foreach (string[] row in dilemmes)
            {
                string text = $"Id : {row[0]}, Choix 1 : {row[1]}, Choix 2 : {row[2]}, Archiver : {row[3]},Categorie : {functionDB.GetNomCategoryById(Convert.ToInt32(row[4]))}";
                lsbDilemmes.Items.Add(text);
            }
        }

        /// <summary>
        /// Affiche les categories transmis en paramètres dans la listbox categorie
        /// </summary>
        /// <param name="categories">les categories a afficher</param>
        private void LoadDataInListBoxCategorie(List<string[]> categories)
        {
            lsbCategorie.Items.Clear();
            foreach (string[] row in categories)
            {
                string text = $" ID : {row[0]} - Nom : {row[1]} - Archiver : {row[2]} ";
                lsbCategorie.Items.Add(text);
            }
        }

        /// <summary>
        /// Affiche les categories transmis en paramètre dans le combobox catégorie
        /// </summary>
        /// <param name="results">les categories a afficher</param>
        private void LoadCategoriesToComboBox(List<string[]> results)
        {
            cbxCategorie.Items.Clear();
            foreach (string[] row in results)
            {
                // Ajouter le nom de la catégorie à la ComboBox
                cbxCategorie.Items.Add(row[1]);
            }
        }

        private void btnAjouter_Click(object sender, EventArgs e)
        {
            frmAjouterModifierDilemme ajouterDilemme = new frmAjouterModifierDilemme(functionDB);

            DialogResult result = ajouterDilemme.ShowDialog();

            if (result == DialogResult.OK)
            {
                functionDB.AddDilemma(ajouterDilemme.GetChoix1(), ajouterDilemme.GetChoix2(), ajouterDilemme.GetCategorie());
                LoadDataInListBoxDilemme(functionDB.GetAllDilemma());
            }
        }

        /// <summary>
        /// Active ou désactive le bouton de recherche si le textbox n'est pas vide
        /// </summary>
        private void tbxRechercheDilemme_TextChanged(object sender, EventArgs e)
        {
            btnRechercheDilemme.Enabled = tbxRechercheDilemme.Text != "";
        }

        private void btnRechercheDilemme_Click(object sender, EventArgs e)
        {
            int id = functionDB.GetIdCategoryByName(tbxRechercheDilemme.Text);
            if (id != -1)
            {
                LoadDataInListBoxDilemme(functionDB.GetAllDilemmaOfCategory(tbxRechercheDilemme.Text));
            }
            else
            {
                MessageBox.Show("Cette catégorie n'existe pas", "Attention");
            }
        }
        
        /// <summary>
        /// Bouton pour afficher tous les dilemmes dans la listbox
        /// </summary>
        private void btnResetDilemme_Click(object sender, EventArgs e)
        {
            LoadDataInListBoxDilemme(functionDB.GetAllDilemma());
        }

        /// <summary>
        /// Active ou désactive les boutons pour modifier et supprimer si un élément de la listbox est séléctionné
        /// </summary>
        private void lsbDilemmes_SelectedIndexChanged(object sender, EventArgs e)
        {
            btnSupprimerDilemme.Enabled = lsbDilemmes.SelectedItem != null;
            btnModifierDilemme.Enabled = lsbDilemmes.SelectedItem != null;
        }

        private void btnSupprimerDilemme_Click(object sender, EventArgs e)
        {
            if (lsbDilemmes.SelectedItem != null)
            {
                // Récupère l'id dans le texte
                string[] array = lsbDilemmes.SelectedItem.ToString().Split(',');
                int id = Convert.ToInt32(array[0].Substring(array.Length));

                functionDB.ArchiveDilemma(id);

                // Recharge les données
                LoadDataInListBoxDilemme(functionDB.GetAllDilemma());
            }
            else
            {
                MessageBox.Show("Il faut séléctionner un dilemme");
            }
        }

        private void btnModifierDilemme_Click(object sender, EventArgs e)
        {
            if (lsbDilemmes.SelectedItem != null)
            {
                // Récupère l'id dans le texte
                string[] arrayData = lsbDilemmes.SelectedItem.ToString().Split(',');
                int id = Convert.ToInt32(arrayData[0].Substring(arrayData.Length));

                frmAjouterModifierDilemme modifierDilemme = new frmAjouterModifierDilemme(functionDB, functionDB.GetDilemmaOfId(id));
                DialogResult result = modifierDilemme.ShowDialog();

                if (result == DialogResult.OK)
                {
                    functionDB.UpdateDilemme(modifierDilemme.GetChoix1(), modifierDilemme.GetChoix2(), functionDB.GetIdCategoryByName(modifierDilemme.GetCategorie()), modifierDilemme.GetArchiver(), id);

                    // Recharge les données
                    LoadDataInListBoxDilemme(functionDB.GetAllDilemma());
                }
            }
            else
            {
                MessageBox.Show("Il faut séléctionner un dilemme");
            }
        }

        private void btnAjoutCategorie_Click(object sender, EventArgs e)
        {
            if (!string.IsNullOrWhiteSpace(tbxCategorie.Text))
            {
                string result = functionDB.AddCategory(tbxCategorie.Text);
                MessageBox.Show(result);
                
                // Rafraîchir la liste des catégories dans la ComboBox après l'ajout
                LoadCategoriesToComboBox(functionDB.GetAllCategory());
            }
            else
            {
                MessageBox.Show("Veuillez entrer le nom de la nouvelle catégorie.");
            }
        }

        private void lsbCategorie_SelectedIndexChanged(object sender, EventArgs e)
        {
            // Vérifier si un élément est sélectionné dans la ListBox
            if (lsbCategorie.SelectedItem != null)
            {
                // Supposons que le texte de l'élément sélectionné est au format "ID : 1 - Nom : Ecologie - Archiver : False"
                string selectedItem = lsbCategorie.SelectedItem.ToString();

                // Extraire l'ID de l'élément sélectionné
                int id;
                string[] parts = selectedItem.Split(new string[] { "ID :" }, StringSplitOptions.RemoveEmptyEntries);
                if (parts.Length >= 2)
                {
                    string idPart = parts[1].Split('-')[0].Trim();
                    if (int.TryParse(idPart, out id))
                    {
                        // Appeler la méthode ToggleArchive avec l'ID extrait
                        functionDB.ToggleArchive(id);
                    }
                }
                LoadDataInListBoxCategorie(functionDB.GetAllCategory());
            }
        }

        private void btnModifierCategorie_Click(object sender, EventArgs e)
        {
            if (!string.IsNullOrWhiteSpace(tbxModifierCategorie.Text))
            {
                functionDB.ModifyCategoryName(cbxCategorie.Text, tbxModifierCategorie.Text);

                // Met a jour l'affichage
                LoadDataInListBoxCategorie(functionDB.GetAllCategory());
                LoadCategoriesToComboBox(functionDB.GetAllCategory());
                LoadDataInListBoxDilemme(functionDB.GetAllDilemma());
                cbxCategorie.Text = tbxModifierCategorie.Text;
            }
            else
            {
                MessageBox.Show("Veuillez entrer le nom de la catégorie a modifiée.");
            }
        }

        private void cbxCategorie_SelectedIndexChanged(object sender, EventArgs e)
        {
            LoadDataInListBoxCategorie(functionDB.GetAllCategory());
            tbxModifierCategorie.Text = cbxCategorie.Text;
        }
    }
}
